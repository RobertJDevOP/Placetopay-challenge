<?php

namespace App\Http\Controllers;

use App\Http\Request\Products\IndexRequest;
use App\Http\Request\Products\IndexUpdateRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Reports;
use App\Reports\ReportsContract;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\ViewModels\Products\IndexViewModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;


class ProductController extends Controller
{

    public function index(IndexViewModel $viewModel): View
    {
        $products=Product::select('id','product_name','url_product_img','price','category_id','created_at',
            'updated_at','enabled_at','list_price')->with('category')
            ->paginate(5);
        $viewModel->collection($products);

        return view('products.index', $viewModel->toArray());
    }

    //create
    public function categories(ProductCategory $categories)
    {
        $data = $categories->all();
        return view('products.create')->with('candies', $data);
    }

    public function statusProduct(int $id,Request $request): RedirectResponse
    {
        $statusProduct = $request->input('validation');
        $product = Product::where('id', $id)->firstOrFail();

        ('enabled'===$statusProduct) ?
            $product->markAsDisabled()
            :
            $product->markAsEnabled();

        return redirect('/products')->with('success',Lang::get('messages.productStatus'));
    }
    public function edit(string $id): View
    {
        $product = Product::where('id', '=', $id)->with('category')->firstOrFail();
        $data = ProductCategory::all();
        return view('products.edit')->with('product',$product)
                                            ->with('candies', $data);
    }

    public function update(IndexUpdateRequest $request, string $id): RedirectResponse
    {
        $product = Product::where('id', '=', $id)->firstOrFail();


        $product->product_name = $request->get('product_name');
        $product->category_id = $request->get('category_id');
        $product->list_price = $request->get('list_price');
        $product->price = $request->get('price');


        if ($request->file('url_product_img')) {

            Storage::disk('public')->delete('images/'.$product->url_product_img);

            $image = $request->file('url_product_img');
            $fileName = time().'.'.$image->getClientOriginalExtension();

            $image->storeAs('public/images',$fileName);
            $product->url_product_img = $fileName;
        }

        $product->save();

         return redirect('/products')->with('success',Lang::get('messages.userUpdate'));
    }

    public function register(IndexRequest $request)
    {
        $image = $request->file('url_product_img');
        $fileName = time().'.'.$image->getClientOriginalExtension();

        $image->storeAs('public/images',$fileName);

        $product = Product::create([
            'product_name' => $request->input('product_name'),
            'category_id' =>$request->input('category_id'),
            'list_price' => $request->input('list_price'),
            'price' =>$request->input('price'),
            'url_product_img' => $fileName
        ]);

        $product->markAsEnabled();

        return redirect('/products')->with('success',Lang::get('messages.productSaved'));
    }

    public function generateReport(): void
    {
        $report = app()->make(ReportsContract::class, ['typeReport'=>'productReport']);

        $report->generate();
    }

    public function getExportStatus(string $typeReport): JsonResponse
    {
        $reportStatus=Reports::select('status','created_at','updated_at','path')->where('name', $typeReport)
                                                        ->latest('id_report')->first();

        $response =(empty($reportStatus))? ['status'=>'WITHOUT_PROCESSING','exportPath'=>''] : ['status'=>$reportStatus->status,'exportPath'=>$reportStatus->path];

        return response()->json($response);
    }

    public function importProducts(Request $request)
    {
        $report = app()->make(ReportsContract::class, ['typeReport'=>'importProducts' ,'file' =>  $request->file('file')->store('temp')]);

        $report->generate();
    }
}

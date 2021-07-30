<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Brand;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\Test;
use App\Models\voucher;
use Carbon\Carbon;
use Image;

class ProductController extends Controller
{

    public function AddProduct()
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('backend.product.product_add', compact('categories', 'brands'));
    }

    public function StoreProduct(Request $request)
    {
        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(917, 1000)->save('upload/products/thumbnail/' . $name_gen);
        $save_url = 'upload/products/thumbnail/' . $name_gen;

        $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,

            'product_name_en' => $request->product_name_en,
            'product_name_id' => $request->product_name_id,
            'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_slug_id' => str_replace(' ', '-', $request->product_name_id),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_id' => $request->product_tags_id,
            'product_size_en' => $request->product_size_en,
            'product_size_id' => $request->product_size_id,
            'product_color_en' => $request->product_color_en,
            'product_color_id' => $request->product_color_id,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_desc_en' => $request->short_desc_en,
            'short_desc_id' => $request->short_desc_id,
            'long_desc_en' => $request->long_desc_en,
            'long_desc_id' => $request->long_desc_id,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,

            'product_thumbnail' => $save_url,
            'status' => 1,
            'created_at' => Carbon::now()
        ]);

        // Start Multiple Image Upload

        $images = $request->file('multi_img');
        foreach ($images as $img) {
            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(917, 1000)->save('upload/products/multi-image/' . $make_name);
            $uploadPath = 'upload/products/multi-image/' . $make_name;

            MultiImg::insert([
                'product_id' => $product_id,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now()
            ]);
        }

        // End Multiple Image Upload

        $notification = array(
            'message' => 'Product Added successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('manage-product')->with($notification);
    }

    public function ManageProduct()
    {
        $products = Product::latest()->get();
        return view('backend.product.product_view', compact('products'));
    }

    public function EditProduct($id)
    {
        $multiImgs = MultiImg::where('product_id', $id)->get();

        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $subcategory = SubCategory::latest()->get();
        $subsubcategory = SubSubCategory::latest()->get();
        $products = Product::findOrFail($id);
        return view('backend.product.product_edit', compact('categories', 'brands', 'subcategory', 'subsubcategory', 'products', 'multiImgs'));
    }

    public function ProductDataUpdate(Request $request)
    {
        $product_id = $request->id;
        Product::findOrFail($product_id)->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,

            'product_name_en' => $request->product_name_en,
            'product_name_id' => $request->product_name_id,
            'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_slug_id' => str_replace(' ', '-', $request->product_name_id),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_id' => $request->product_tags_id,
            'product_size_en' => $request->product_size_en,
            'product_size_id' => $request->product_size_id,
            'product_color_en' => $request->product_color_en,
            'product_color_id' => $request->product_color_id,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_desc_en' => $request->short_desc_en,
            'short_desc_id' => $request->short_desc_id,
            'long_desc_en' => $request->long_desc_en,
            'long_desc_id' => $request->long_desc_id,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,

            'status' => 1,
            'updated_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Product Updated Without Image successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('manage-product')->with($notification);
    }

    public function ProductDelete($id)
    {
        $product = Product::findOrFail($id);
        unlink($product->product_thumbnail);
        Product::findOrFail($id)->delete();

        $images = MultiImg::where('product_id', $id)->get();
        foreach ($images as $img) {
            unlink($img->photo_name);
            MultiImg::where('product_id', $id)->delete();
        }

        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function DetailProduct($id)
    {
        $multiImgs = MultiImg::where('product_id', $id)->get();

        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $subcategory = SubCategory::latest()->get();
        $subsubcategory = SubSubCategory::latest()->get();
        $products = Product::findOrFail($id);
        return view('backend.product.product_detail', compact('categories', 'brands', 'subcategory', 'subsubcategory', 'products', 'multiImgs'));
    }

    public function MultImageUpdate(Request $request)
    {

        $imgs = $request->multi_img;

        foreach ($imgs as $id => $img) {

            $imgDel = MultiImg::findOrFail($id);
            unlink($imgDel->photo_name);

            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(917, 1000)->save('upload/products/multi-image/' . $make_name);
            $save_img = 'upload/products/multi-image/' . $make_name;

            MultiImg::where('id', $id)->update([
                'photo_name' => $save_img,
                'updated_at' => Carbon::now()
            ]);

            // $Multi = $request->file('multi_img');
            // foreach ($Multi as $img) {
            //     $make_imgMulti = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            //     Image::make($img)->resize(917, 1000)->save('upload/products/multi-image/' . $make_imgMulti);
            //     $uploadPathNewMulti = 'upload/products/multi-image/' . $make_imgMulti;
            //     MultiImg::insert([
            //         'product_id' => $id,
            //         'photo_name' => $uploadPathNewMulti,
            //         'created_at' => Carbon::now()
            //     ]);
            // }
        }

        $notification = array(
            'message' => 'Product image updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('manage-product')->with($notification);
    }

    public function ThumbnailImageUpdate(Request $request)
    {
        $pro_id = $request->id;
        $oldImage = $request->old_image;
        unlink($oldImage);

        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(917, 1000)->save('upload/products/thumbnail/' . $name_gen);
        $save_url = 'upload/products/thumbnail/' . $name_gen;

        Product::findOrFail($pro_id)->update([
            'product_thumbnail' => $save_url,
            'updated_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Product image thumbnail updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('manage-product')->with($notification);
    }

    public function MultImageDelete($id)
    {
        $oldimg = MultiImg::findOrFail($id);
        unlink($oldimg->photo_name);
        MultiImg::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Product image multi deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function ProductDeactive($id)
    {
        Product::findOrFail($id)->update([
            'status' => 0
        ]);

        $notification = array(
            'message' => 'Product Deactivated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function ProductActive($id)
    {
        Product::findOrFail($id)->update([
            'status' => 1
        ]);

        $notification = array(
            'message' => 'Product Activated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function testView()
    {
        $voucher = voucher::latest()->get();
        return view('backend.product.test', compact('voucher'));
    }

    public function testAdd(Request $request)
    {
        voucher::insert([
            'potongan' => $request->potongan
        ]);

        $notification = array(
            'message' => 'Potongan Berhasil ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('view.potongan')->with($notification);
    }

    public function testEdit($id)
    {
        $voucher = voucher::findOrFail($id);
        return view('backend.product.test_edit', compact('voucher'));
    }

    public function testUpdate(Request $request)
    {
        $id = $request->id;
        voucher::findOrFail($id)->update([
            'potongan' => $request->potongan
        ]);

        $notification = array(
            'message' => 'Potongan Berhasil diperbarui',
            'alert-type' => 'success'
        );

        return redirect()->route('view.potongan')->with($notification);
    }

    public function testDelete($id)
    {
        voucher::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Potongan Berhasil dihapus',
            'alert-type' => 'success'
        );

        return redirect()->route('view.potongan')->with($notification);
    }
}

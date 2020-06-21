<?php

namespace App\Http\Controllers\Admin;

use App\Dienthoai;
use App\Http\Requests\DienthoaiCreateRequest;
use App\Http\Requests\DienthoaiUpdateRequest;
use App\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Photo;

class AdminPhonesController extends Controller
{
    public function index()
    {
        $phones = Dienthoai::with('danhmuc', 'noisanxuat', 'image')
            ->orderBy('id', 'DESC')
            ->get();
        return view('admin.books.index', compact('phones'));
    }

    public function create()
    {
        return view('admin.books.create');
    }

    public function store(DienthoaiCreateRequest $request)
    {
        $input = $request->all();

        $count_discount = (($request->init_price * $request->discount_rate)/100);
        $final_price  = $request->init_price - $count_discount;
        $input['price'] = $final_price;

        if($file = $request->file('image_id'))
        {
            $name = time().$file->getClientOriginalName();

            $image_resize = Photo::make($file->getRealPath());
            $image_resize->resize(340,380);
            $image_resize->save(public_path('assets/img/' .$name));

            $image = Image::create(['file'=>$name]);
            $input['image_id'] = $image->id;
        }

        $create_phones = Dienthoai::create($input);

        return redirect('/admin/phones')
            ->with('success_message', 'Phone created successfully');
    }

    public function edit($id)
    {
        $book = Dienthoai::findOrFail($id);

        return view('admin.books.edit', compact('book'));
    }

    public function update(DienthoaiUpdateRequest $request, $id)
    {
        $input = $request->all();

        $count_discount = (($request->init_price * $request->discount_rate)/100);
        $final_price  = $request->init_price - $count_discount;
        $input['price'] = $final_price;

        if($file = $request->file('image_id'))
        {
            $name = time().$file->getClientOriginalName();

            $image_resize = Photo::make($file->getRealPath());
            $image_resize->resize(340,380);
            $image_resize->save(public_path('assets/img/' .$name));

            $image = Image::create(['file'=>$name]);
            $input['image_id'] = $image->id;
        }

        $book = Dienthoai::findOrFail($id);
        $book->update($input);

        return redirect('/admin/phones')
            ->with('success_message', 'Phone updated successfully');
    }

    public function destroy($id)
    {
        $book= Dienthoai::findOrFail($id);
        $book->delete();
        return redirect()->back()->with('alert_message', 'Phone move to trash');
    }

    public function restore($id)
    {
        $trash = Dienthoai::onlyTrashed()->findOrFail($id);
        $trash->restore();
        return redirect()->back()
            ->with('success_message', 'Phone successfully restore from trash');
    }

    public function forceDelete($id)
    {
        $trash_book = Dienthoai::onlyTrashed()->findOrfail($id);
        if(!is_null($trash_book->image_id))
        {
            unlink(public_path().'/assets/img/'.$trash_book->image->file);
        }
        $trash_book->image->delete();
        $trash_book->forceDelete();
        return redirect()->back()
            ->with('alert_message', 'Phone deleted permanently');
    }

    public function trashPhones()
    {
        $books = Dienthoai::onlyTrashed()->orderBy('id', 'DESC')->get();
        return view('admin.books.trash-books', compact('books'));
    }

    public function discountPhones()
    {
        $discount_phones = "All phones with discount";
        $phones = Dienthoai::with('noisanxuat', 'danhmuc')
            ->orderBy('discount_rate', 'DESC')
            ->where('discount_rate', '>', 0)->get();

        return view('admin.books.index', compact('phones', 'discount_phones'));
    }
}

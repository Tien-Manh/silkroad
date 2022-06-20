<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use File;
use Illuminate\Support\Facades\Cache;


class AdminController extends Controller
{
    public function index(){
        return view('admins.index');
    }


    public function download(){
        $download = DB::table('download')->orderBy('id', 'desc')->paginate(8);
        return view('admins.download', compact('download'));
    }
    public function downloadAdd(){
        return view('admins.form-download');
    } 
    public function downloadAddSave(Request $rq){
        $rule = [
            'link' => 'required',
            'name' => 'required',
            'icon' => 'required',
            'local' => 'required'
        ];
        $message = [
        'link.required' => 'link chưa nhập',
        'name.required' => 'Name chưa nhập',
        'local.required' => 'Local Name chưa nhập',
        'icon.required' => 'Icon chưa nhập'
        ];
        $check = Validator::make($rq->all(), $rule, $message);
        if ($check->passes()) {
            DB::table('download')->insert([
                'service' => $rq->service,
                'link' => $rq->link,
                'name' => $rq->name,
                'local' => $rq->local,
                'icon' => $rq->icon,
                'type' => $rq->type
            ]);
            return redirect()->back()->with('msg', 'Thêm thành công');
        }
        
        else{
            $textError = '';
            foreach ($check->errors()->toArray() as $key => $value) {
                $textError .= $value[0] . " ! <br>";
            }
            return redirect()->back()->withInput()->with('msg', $textError);
        }
    }
    public function downloadEdit($id){
        $download = DB::table('download')->find($id);
        return view('admins.formedit-download', compact('download'));
    }
    public function downloadEditSave(Request $rq){
        $rule = [
            'link' => 'required',
            'name' => 'required',
            'icon' => 'required',
            'local' => 'required'
        ];
        $message = [
        'link.required' => 'link chưa nhập',
        'name.required' => 'Name chưa nhập',
        'local.required' => 'Local Name chưa nhập',
        'icon.required' => 'Icon chưa nhập',
        ];
        $check = Validator::make($rq->all(), $rule, $message);
        if ($check->passes()) {

            DB::table('download')->where('id', $rq->id)->update([
                'service' => $rq->service,
                'link' => $rq->link,
                'name' => $rq->name,
                'local' => $rq->local,
                'icon' => trim($rq->icon),
                'type' => $rq->type
            ]);
            return redirect()->back()->with('msg', 'Sửa thành công');
        }
        
        else{
            $textError = '';
            foreach ($check->errors()->toArray() as $key => $value) {
                $textError .= $value[0] . " ! <br>";
            }
            return redirect()->back()->withInput()->with('msg', $textError);
        }
    }

    public function downloadDelete($id){
        DB::table('download')->where('id', $id)->delete();
        return redirect()->back();
    }



     public function card(){
        $card = DB::table('cardconfig')->orderBy('id', 'desc')->paginate(8);
        return view('admins.cards.card', compact('card'));
    }
    public function cardAdd(){
        return view('admins.cards.form-card');
    } 
    public function cardAddSave(Request $rq){
        $rule = [
            'silk' => 'required',
            'typeAmount' => 'required'
        ];
        $message = [
        'silk.required' => 'Silk chưa nhập',
        'typeAmount.required' => 'Mệnh giá chưa nhập',
        ];
        $check = Validator::make($rq->all(), $rule, $message);
        if ($check->passes()) {
            DB::table('cardconfig')->insert([
                'silk' => $rq->silk,
                'typeAmout' => $rq->typeAmount,
            ]);
            return redirect()->back()->with('msg', 'Thêm thành công');
        }
        
        else{
            $textError = '';
            foreach ($check->errors()->toArray() as $key => $value) {
                $textError .= $value[0] . " ! <br>";
            }
            return redirect()->back()->withInput()->with('msg', $textError);
        }
    }
    public function cardEdit($id){
        $card = DB::table('cardconfig')->find($id);
        return view('admins.cards.formedit-card', compact('card'));
    }
    public function cardEditSave(Request $rq){
        $rule = [
            'silk' => 'required',
            'typeAmount' => 'required'
        ];
        $message = [
        'silk.required' => 'Silk chưa nhập',
        'typeAmount.required' => 'Mệnh giá chưa nhập',
        ];
        $check = Validator::make($rq->all(), $rule, $message);
        if ($check->passes()) {

            DB::table('cardconfig')->where('id', $rq->id)->update([
                'silk' => $rq->silk,
                'typeAmout' => $rq->typeAmount,
            ]);
            return redirect()->back()->with('msg', 'Sửa thành công');
        }
        
        else{
            $textError = '';
            foreach ($check->errors()->toArray() as $key => $value) {
                $textError .= $value[0] . " ! <br>";
            }
            return redirect()->back()->withInput()->with('msg', $textError);
        }
    }

    public function cardDelete($id){
        DB::table('cardconfig')->where('id', $id)->delete();
        return redirect()->back();
    }



    public function cardLog(){
        $cardlog = DB::table('card')->orderBy('id', 'desc')->paginate(8);
        return view('admins.cards.card-log', compact('cardlog'));
    }

    public function deleteCardLog($id){
        DB::table('card')->where('id', $id)->delete();
        return redirect()->back();
    }



    public function pay(){
        $pay = DB::table('paypal')->orderBy('id', 'desc')->paginate(8);
        return view('admins.pays.index', compact('pay'));
    }
    public function payAdd(){
        return view('admins.pays.add');
    } 
    public function payAddSave(Request $rq){
        $rule = [
            'title' => 'required',
            'atm' => 'required',
            'bank' => 'required',
            'name' => 'required',
            'content' => 'required'
        ];
        $message = [
        'title.required' => 'Tiêu đề chưa nhập',
        'atm.required' => 'Số tài khoản chưa nhập',
        'bank.required' => 'Tên ngân hàng chưa nhập',
        'name.required' => 'Tên chưa nhập',
        'content.required' => 'Nội dung chưa nhập'
        ];
        $check = Validator::make($rq->all(), $rule, $message);
        if ($check->passes()) {
            DB::table('paypal')->insert([
                'title' => $rq->title,
                'atm' => $rq->atm,
                'bank' => $rq->bank,
                'name' => $rq->name,
                'content' => $rq->content,
                'service' => $rq->service
            ]);
            return redirect()->back()->with('msg', 'Thêm thành công');
        }
        
        else{
            $textError = '';
            foreach ($check->errors()->toArray() as $key => $value) {
                $textError .= $value[0] . " ! <br>";
            }
            return redirect()->back()->withInput()->with('msg', $textError);
        }
    }
    public function payEdit($id){
        $pay = DB::table('paypal')->find($id);
        return view('admins.pays.edit', compact('pay'));
    }
    public function payEditSave(Request $rq){
        $rule = [
            'title' => 'required',
            'atm' => 'required',
            'bank' => 'required',
            'name' => 'required',
            'content' => 'required'
        ];
        $message = [
        'title.required' => 'Tiêu đề chưa nhập',
        'atm.required' => 'Số tài khoản chưa nhập',
        'bank.required' => 'Tên ngân hàng chưa nhập',
        'name.required' => 'Tên chưa nhập',
        'content.required' => 'Nội dung chưa nhập'
        ];
        $check = Validator::make($rq->all(), $rule, $message);
        if ($check->passes()) {

            DB::table('paypal')->where('id', $rq->id)->update([
                'title' => $rq->title,
                'atm' => $rq->atm,
                'bank' => $rq->bank,
                'name' => $rq->name,
                'content' => $rq->content,
                'service' => $rq->service
            ]);
            return redirect()->back()->with('msg', 'Sửa thành công');
        }
        
        else{
            $textError = '';
            foreach ($check->errors()->toArray() as $key => $value) {
                $textError .= $value[0] . " ! <br>";
            }
            return redirect()->back()->withInput()->with('msg', $textError);
        }
    }
    public function payDelete($id){
        DB::table('paypal')->where('id', $id)->delete();
        return redirect()->back();
    }



    public function support(){
        $support = DB::table('supmember')->orderBy('id', 'desc')->paginate(8);
        return view('admins.supports.index', compact('support'));
    }
    public function supportAdd(){
        return view('admins.supports.add');
    } 
    public function supportAddSave(Request $rq){
        $rule = [
            'title' => 'required',
            'code' => 'required',
            'service' => 'required',
            'content' => 'required'
        ];
        $message = [
        'title.required' => 'Tiêu đề chưa nhập',
        'code.required' => 'Số tài khoản chưa nhập',
        'service.required' => 'Tên ngân hàng chưa nhập',
        'content.required' => 'Nội dung chưa nhập'
        ];
        $check = Validator::make($rq->all(), $rule, $message);
        if ($check->passes()) {
            DB::table('supmember')->insert([
                'title' => $rq->title,
                'code' => $rq->code,
                'content' => $rq->content,
                'service' => $rq->service
            ]);
            return redirect()->back()->with('msg', 'Thêm thành công');
        }
        
        else{
            $textError = '';
            foreach ($check->errors()->toArray() as $key => $value) {
                $textError .= $value[0] . " ! <br>";
            }
            return redirect()->back()->withInput()->with('msg', $textError);
        }
    }
    public function supportEdit($id){
        $support = DB::table('supmember')->find($id);
        return view('admins.supports.edit', compact('support'));
    }
    public function supportEditSave(Request $rq){
        $rule = [
            'title' => 'required',
            'code' => 'required',
            'service' => 'required',
            'content' => 'required'
        ];
        $message = [
        'title.required' => 'Tiêu đề chưa nhập',
        'code.required' => 'Số tài khoản chưa nhập',
        'service.required' => 'Tên ngân hàng chưa nhập',
        'content.required' => 'Nội dung chưa nhập'
        ];
        $check = Validator::make($rq->all(), $rule, $message);
        if ($check->passes()) {

            DB::table('supmember')->where('id', $rq->id)->update([
                'title' => $rq->title,
                'code' => $rq->code,
                'content' => $rq->content,
                'service' => $rq->service
            ]);
            return redirect()->back()->with('msg', 'Sửa thành công');
        }
        
        else{
            $textError = '';
            foreach ($check->errors()->toArray() as $key => $value) {
                $textError .= $value[0] . " ! <br>";
            }
            return redirect()->back()->withInput()->with('msg', $textError);
        }
    }
    public function supportDelete($id){
        DB::table('supmember')->where('id', $id)->delete();
        return redirect()->back();
    }



    public function config(){
        $config = DB::table('servertype')->where('type', '<>', 'store_img')->orderBy('id', 'desc')->paginate(8);
        return view('admins.configs.index', compact('config'));
    }
    public function configAdd(){
        return view('admins.configs.add');
    } 
    public function configAddSave(Request $rq){
        $rule = [
            'type' => 'required',
            'value' => 'required',
            'service' => 'required'
        ];
        $message = [
        'type.required' => 'Tên chưa nhập',
        'value.required' => 'Giá trị chưa nhập',
        'service.required' => 'Service chưa nhập',
        ];
        $check = Validator::make($rq->all(), $rule, $message);
        if ($check->passes()) {
            DB::table('servertype')->insert([
                'type' => $rq->type,
                'value' => $rq->value,
                'service' => $rq->service
            ]);
            return redirect()->back()->with('msg', 'Thêm thành công');
        }
        
        else{
            $textError = '';
            foreach ($check->errors()->toArray() as $key => $value) {
                $textError .= $value[0] . " ! <br>";
            }
            return redirect()->back()->withInput()->with('msg', $textError);
        }
    }
    public function configEdit($id){
        $config = DB::table('servertype')->find($id);
        if($config->type == 'store_img'){
            return redirect()->back();
        }
        return view('admins.configs.edit', compact('config'));
    }
    public function configEditSave(Request $rq){
        $rule = [
            'type' => 'required',
            'value' => 'required',
            'service' => 'required'
        ];
        $message = [
            'type.required' => 'Tên chưa nhập',
            'value.required' => 'Giá trị chưa nhập',
            'service.required' => 'Service chưa nhập',
        ];
        $check = Validator::make($rq->all(), $rule, $message);
        if ($check->passes()) {

            DB::table('servertype')->where('id', $rq->id)->update([
                'type' => $rq->type,
                'value' => $rq->value,
                'service' => $rq->service
            ]);
            return redirect()->back()->with('msg', 'Sửa thành công');
        }
        
        else{
            $textError = '';
            foreach ($check->errors()->toArray() as $key => $value) {
                $textError .= $value[0] . " ! <br>";
            }
            return redirect()->back()->withInput()->with('msg', $textError);
        }
    }
    public function configDelete($id){
        DB::table('servertype')->where('type', '<>', 'store_img')->where('id', $id)->delete();
        return redirect()->back();
    }



    public function baner(){
        $baner = DB::table('banerinfo')->orderBy('id', 'desc')->paginate(8);
        return view('admins.baners.index', compact('baner'));
    }
    public function banerAdd(){
        return view('admins.baners.add');
    } 
    public function banerAddSave(Request $rq){
        $rule = [
            'img' => 'required',
        ];
        $message = [
        'img.required' => 'Chưa chọn ảnh'
        ];
        $check = Validator::make($rq->all(), $rule, $message);
        if ($check->passes()) {
            $file = $rq->img;
            $filename = time() . $file->getClientOriginalName();
            $file->move('admins/images/baners', $filename);
            DB::table('banerinfo')->insert([
                'img' => $filename,
                'content' => $rq->content,
                'service' => $rq->service
            ]);
            return redirect()->back()->with('msg', 'Thêm thành công');
        }
        
        else{
            $textError = '';
            foreach ($check->errors()->toArray() as $key => $value) {
                $textError .= $value[0] . " ! <br>";
            }
            return redirect()->back()->withInput()->with('msg', $textError);
        }
    }
    public function banerEdit($id){
        $baner = DB::table('banerinfo')->find($id);
        return view('admins.baners.edit', compact('baner'));
    }
    public function banerEditSave(Request $rq){
        $banner = DB::table('banerinfo')->where('id', $rq->id)->first();
        $file_x = $banner->img;
        $filename = $banner->img;
        if ($rq->hasFile('img')){
            $file = $rq->img;
            $filename = time() . $file->getClientOriginalName();
            File::delete('admins/images/baners/'. $file_x);
            $file->move('admins/images/baners', $filename);
        }
        DB::table('banerinfo')->where('id', $rq->id)->update([
            'img' => $filename,
            'content' => $rq->content,
            'service' => $rq->service
        ]);
        return redirect()->back()->with('msg', 'Sửa thành công');
    }

    public function banerDelete($id){
        $banner = DB::table('banerinfo')->where('id', $id)->first();
        $file_x = $banner->img;
        DB::table('banerinfo')->where('id', $id)->delete();
        File::delete('admins/images/baners/'. $file_x);
        return redirect()->back();
    }

    public function createImg(){
        $storeImg = DB::table('servertype')->where('type', 'store_img')->paginate(8);
        return view('admins.imgs.index', compact('storeImg'));
    }
    public function addImg(){
        return view('admins.imgs.add');
    }

    public function saveImg(Request $rq){
        $rule = [
            'img' => 'required',
        ];
        $message = [
            'img.required' => 'Chưa chọn ảnh'
        ];
        $check = Validator::make($rq->all(), $rule, $message);
        if ($check->passes()) {
            $file = $rq->img;
            $filename = time() . $file->getClientOriginalName();
            $file->move('admins/images/storages', $filename);
            DB::table('servertype')->insert([
                'value' => $filename,
                'type' => 'store_img',
                'service' => $rq->service
            ]);
            return redirect()->back()->with('msg', 'Thêm thành công');
        }
        else{
            $textError = '';
            foreach ($check->errors()->toArray() as $key => $value) {
                $textError .= $value[0] . " ! <br>";
            }
            return redirect()->back()->withInput()->with('msg', $textError);
        }
        
    }

    public function editImg($id){
        $storeImg = DB::table('servertype')->find($id);
        return view('admins.imgs.edit', compact('storeImg'));
    }

    public function saveUpdateImg(Request $rq){
         $rule = [
            'img' => 'required',
        ];
        $message = [
            'img.required' => 'Chưa chọn ảnh'
        ];
        $check = Validator::make($rq->all(), $rule, $message);
        $storeImg = DB::table('servertype')->where('id', $rq->id)->first();;
        $file_x = $storeImg->value;
        $filename = $storeImg->value;
        if ($rq->hasFile('img')){
            $file = $rq->img;
            $filename = time() . $file->getClientOriginalName();
            File::delete('admins/images/storages/'. $file_x);
            $file->move('admins/images/storages', $filename);

            DB::table('servertype')->where('id', $rq->id)->update([
                'value' => $filename,
                'type' => 'store_img',
                'service' => $rq->service
            ]);
        }
        else{
            $textError = '';
            foreach ($check->errors()->toArray() as $key => $value) {
                $textError .= $value[0] . " ! <br>";
            }
            return redirect()->back()->withInput()->with('msg', $textError);
        }
        return redirect()->back()->with('msg', 'Sửa thành công');
    }

    public function deleteImg($id){
        $storeImg = DB::table('servertype')->where('id', $id)->first();
        $file_x = $storeImg->value;
        DB::table('servertype')->where('id', $id)->delete();
        File::delete('admins/images/storages/'. $file_x);
        return redirect()->back();
    }



}

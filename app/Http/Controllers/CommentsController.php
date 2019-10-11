<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Comment;

class CommentsController extends Controller {


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$result = Comment::where('id', '=', $id)->delete();

		if($result) {
			return redirect('/panel')->with('success', 'تم حذف التعليق')->withInput(['tab'=>'nav-comm']);
		}
		else {
			return redirect('/panel')->with('warning', 'حصل خطأ اثناء العملية حاول مرة اخرى')->withInput(['tab'=>'nav-comm']);
		}
	}

	/**
	 * Truncate the comments table data.
	 * 
	 * @return Response
	 */
	public function commentsTruncate()
	{
		$result = Comment::truncate();

		if($result)
		{
			return back()->with('success', 'تم مسح جميع التعليقات')->withInput(['tab'=>'nav-comm']);
		}
		else {
			return back()->with('warning', 'حصل خطأ اثناء العملية')->withInput(['tab'=>'nav-comm']);
		}
	}

}

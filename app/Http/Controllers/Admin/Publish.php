<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin as Models;

class Publish extends Controller
{
    public function categories(Request $request) {
        return response()->json([
            'is_publish' => (bool)Models\Category::update_publish(decrypt($request->id))
        ]);
    }

    public function brand(Request $request) {
        return response()->json([
            'is_publish' => (bool)Models\Brand::update_publish(decrypt($request->id))
        ]);
    }

    public function devices(Request $request) {
        return response()->json([
            'is_publish' => (bool)Models\Device::update_publish(decrypt($request->id))
        ]);
    }

    public function models(Request $request) {
        return response()->json([
            'is_publish' => (bool)Models\Models::update_publish(decrypt($request->id))
        ]);
    }

    public function pages(Request $request) {
        return response()->json([
            'is_publish' => (bool)Models\Page::update_publish(decrypt($request->id))
        ]);
    }

    public function faqs(Request $request) {
        return response()->json([
            'is_publish' => (bool)Models\Faq::update_publish(decrypt($request->id))
        ]);
    }

    public function faqs_group(Request $request) {
        return response()->json([
            'is_publish' => (bool)Models\FaqGroup::update_publish(decrypt($request->id))
        ]);
    }

    public function form_reviews(Request $request) {
        return response()->json([
            'is_publish' => (bool)Models\Review::update_publish(decrypt($request->id))
        ]);
    }

    public function form_contacts(Request $request) {
        return response()->json([
            'is_publish' => (bool)Models\Contact::update_publish(decrypt($request->id))
        ]);
    }

    public function starbuck_locations(Request $request) {
        return response()->json([
            'is_publish' => (bool)Models\StarbuckLocation::update_publish(decrypt($request->id))
        ]);
    }

    public function staffs_group(Request $request) {
        return response()->json([
            'is_publish' => (bool)Models\StaffGroup::update_publish(decrypt($request->id))
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Log;
use Illuminate\Support\Facades\DB;

class LogsController extends Controller
{

    /**
     * @return mixed
     */
    public function index()
    {
        $logs = Log::latest()->paginate(50);

        return view('admin.logs.index', compact('logs'));
    }

    /**
     * Clears the log.
     * 
     * @return mixed
     */
    public function destroy()
    {
        DB::table('logs')->truncate();

        return redirect()->route('backend.admin.logs.index')
                         ->with('success', 'Log cleared successfully.');
    }
}

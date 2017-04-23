<?php

namespace App\Http\Controllers\Admin\Setting;

use File;
use Artisan;
use Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BackupController extends Controller
{
    /**
     * Path to the app/storage/http---localhost-8000
     * @var String
     */
    private $backupPath;

    /**
     * Directory delimiter.
     */
    const DELIMITER = '/';

    public function __construct()
    {
        $this->backupPath = storage_path() . '/app/' . str_replace([':', '/'], '-', env('APP_URL'));
    }

    /**
     * Backup setting.
     * @return view
     */
    public function index()
    {
        // If backup directory exists.
        if (File::exists($this->backupPath)) {
            $backups = array_reverse(File::allFiles($this->backupPath));
        } else {
            $backups = [];
        }
        return view('admin.settings.backup', compact('backups'));
    }

    /**
     * Download backup.
     * @param  String $file
     * @return redirect
     */
    public function download($file)
    {
        if (File::exists($this->backupPath . self::DELIMITER . $file)) {
            return Response::download($this->backupPath . self::DELIMITER . $file);
        } else {
            flash('File not exists.', 'danger');
            return back();
        }
    }

    /**
     * Delete backup.
     * @return redirect
     */
    public function delete($file)
    {
        if (File::exists($this->backupPath . self::DELIMITER . $file)) {
            File::delete($this->backupPath . self::DELIMITER . $file);
            flash('File deleted.', 'success');
            return back();
        } else {
            flash('File not exists.', 'danger');
            return back();
        }
    }

    /**
     * New backup.
     * @return redirect
     */
    public function newBackup()
    {
        Artisan::queue('backup:run');
        flash('New backup created');
        return back();
    }
}

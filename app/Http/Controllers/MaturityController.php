<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\Maturity\IMaturityCreate;
use App\Http\Interfaces\Maturity\IMaturityGet;
use App\Http\Interfaces\Maturity\IMaturityRemove;
use App\Http\Interfaces\Maturity\IMaturityUpdate;
use App\Http\Requests\MaturityRequest;
use Exception;
use Illuminate\Http\Request;

class MaturityController extends Controller
{
    private $maturityCreate;
    private $maturityGet;
    private $maturityUpdate;
    private $maturityRemove;

    public function __construct(IMaturityCreate $maturityCreate, IMaturityGet $maturityGet, IMaturityUpdate $maturityUpdate, IMaturityRemove $maturityRemove)
    {
        $this->maturityCreate = $maturityCreate;
        $this->maturityGet = $maturityGet;
        $this->maturityUpdate = $maturityUpdate;
        $this->maturityRemove = $maturityRemove;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $maturities =  $this->maturityGet->allMaturity();
            return response()->json($maturities);

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
    public function store(MaturityRequest $request)
    {
        try{
            $maturity = $this->maturityCreate->handle($request);
            return response()->json($maturity);

        } catch(Exception $e){
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
            $maturity =  $this->maturityGet->showMaturity($id);
            return response()->json($maturity);
            
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
    public function update(MaturityRequest $request, $id)
    {
        try{
            $this->maturityUpdate->update($request, $id);
            return response()->json([
                'success' => true,
                'message' => 'Registro atualizado com sucesso.'
            ]);

        } catch(Exception $e){
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
            $this->maturityRemove->delete($id);
            return response()->json([
                'success' => true,
                'message' => 'Registro excluído com sucesso!'
                ]
            );

        } catch(Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function search(Request $request)
    {
        try{
            $maturities =  $this->maturityGet->search($request);
            return response()->json($maturities);
            
        } catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}

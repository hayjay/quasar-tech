<?php

namespace App\Http\Controllers;

use App\Interfaces\TransactionRepositoryInterface;
use App\Http\Resources\TransactionResource;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private $transactionRepository;

    /**
     * @param TransactionRepositoryInterface $transactionRepository
     *
     */
    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    /** Gets all transaction logs
     *
     */
    public function fetch()
    {
        try {
            $data = $this->transactionRepository->all();
            return response()->json([
                [
                    'status' => true,
                    'message' => 'Transaction Lists Fetched Successfully!',
                    'data' => TransactionResource::collection($data),
                ]
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => $e->getMessage(),
            ], 403);
        }
    }

    /** Find and Search a specific transaction log
     *
     */
    public function search(Request $request)
    {
        try {
            $data = $this->transactionRepository->findByName($request->keyword);
            return response()->json([
                [
                    'status' => true,
                    'message' => 'Transaction Lists Fetched Successfully!',
                    'data' => TransactionResource::collection($data),
                ]
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => $e->getMessage(),
            ], 403);
        }
    }

}

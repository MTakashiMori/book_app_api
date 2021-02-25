<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

/**
 * Class DbTransaction
 * @package App\Http\Middleware
 */
class DbTransaction
{

    public function handle($request , Closure $next)
    {
        DB::beginTransaction();
        try
        {
            $response = $next($request);
            if($response->exception)
            {
                //if you don't throw the exception it wont get into the catch
                throw $response->exception;
            }
        }
        catch (\Exception $e)//it could be QueryException, but it can be limiting because can occur another excepcion type
        {
            DB::rollBack();
            //if you only care about exceptions, you could roll back here,
            //but if there's no exception and the response code is greater than 399
            //it is no needed to rollback twice, you can wait and roll back once later
            // \DB::rollBack();
        }

        /** @var $response */
        if($response->exception || ($response instanceof Response && $response->getStatusCode() > 399))
        {
            DB::rollBack();
        }
        else
        {
            DB::commit();
        }

        return $response;
    }
}

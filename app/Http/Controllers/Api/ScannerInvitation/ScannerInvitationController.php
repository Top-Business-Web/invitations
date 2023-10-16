<?php

namespace App\Http\Controllers\Api\ScannerInvitation;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\Scanned;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScannerInvitationController extends Controller
{

    public function scannerInvitation(Request $request): JsonResponse{

        $rules = [
            'invitation_id' => 'required|exists:invitations,id',
            'invitee_id' => 'required|exists:invitees,id',
        ];
        $validator = Validator::make($request->all(), $rules, [
            'invitation_id.exists' => 409,
            'invitee_id.exists' => 410,
        ]);
        if ($validator->fails()) {
            $errors = collect($validator->errors())->flatten(1)[0];
            if (is_numeric($errors)) {
                $errors_arr = [
                    409 => 'Failed,The invitation not exists',
                    410 => 'Failed,The Invitee not exists',
                ];
                $code = (int)collect($validator->errors())->flatten(1)[0];
                return helperJson(null, isset($errors_arr[$errors]) ? $errors_arr[$errors] : 500, $code);
            }
            return response()->json(['data' => null, 'message' => $validator->errors()->first(), 'code' => 422], 200);
        }


        if(Scanned::query()->where('invitation_id','=',$request->invitation_id)->where('invitee_id','=',$request->invitee_id)->exists()){

            return helperJson(null, "تم عمل مسح ضوئي للدعوه من قبل",201);

        }else{

            $invitation = Invitation::query()
                ->where('id','=',$request->invitation_id)
                ->first();

            if(Carbon::now()->format('Y-m-d') > $invitation->date){
                return helperJson(null, " تاريخ صلاحيه الدعوه قد انتهي",415);

            }else{
                $addScanInvitation = new Scanned();
                $addScanInvitation->invitation_id = $request->invitation_id;
                $addScanInvitation->invitee_id = $request->invitee_id;
                $addScanInvitation->save();
                if($addScanInvitation->save()){
                    return helperJson($addScanInvitation, "تم تسجيل المسح الضوئي للدعوه بنجاح");

                }else{
                    return helperJson(null, "يوجد خطاء ما اثناء تسجيل المسح الضوئي", 500);

                }
            }




        }


    }



}

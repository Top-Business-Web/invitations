<?php
namespace App\Enums;

class InviteeStatusEnum {
    public const WAITING = 'الانتظار';
    public const ACCEPTED = 'مأكد';
    public const APOLOGIZE = 'تم الاعتذار';
    public const NOT_SENT = 'لم يتم الارسال';
    public const FAILED = 'فشل';
}

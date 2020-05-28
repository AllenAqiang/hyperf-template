<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace App\Constants;

use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

/**
 * @Constants
 */
class ErrorCode extends AbstractConstants
{
    /**
     * @Message("Server Error！")
     */
    const SERVER_ERROR = 500;

    //基本错误码 0～1000
    /**
     * @Message("Authorization has been denied for this request !")
     */
    const AUTH_ERROR = 401;

    /**
     * @Message("No permission to process !")
     */
    const NO_PERMISSION_PROCESS = 402;

    /**
     * @Message("No data available !")
     */
    const NO_DATA_AVAILABLE = 403;

    //用户错误码 3000～3999

    /**
     * @Message("User not found!")
     */
    const USER_NOT_FOUND = 3001;
    /**
     * @Message("The user id is invalid !")
     */
    const USER_ID_INVALID = 3002;
    /**
     * @Message("This mailbox is already in use !")
     */
    const USER_EMAIL_ALREADY_USE = 3003;
    /**
     * @Message("User password input error !")
     */
    const USER_PASSWORD_ERROR = 3004;
    /**
     * @Message("Failed to create user application !")
     */
    const USER_CREATE_APPLICATION_FAIL = 3005;
    /**
     * @Message("application set to read failed")
     */
    const USER_APPLICATION_SET_READ_FAIL = 3006;
    /**
     * @Message("Failed to modify user information !")
     */
    const USER_INFO_MODIFY_FAIL = 3007;

    /**
     * @Message("Application information does not exist !")
     */
    const USER_APPLICATION_NOT_FOUND = 3008;

    /**
     * @Message("Application information has been processed !")
     */
    const USER_APPLICATION_PROCESSED = 3009;

    /**
     * @Message("Wrong application type !")
     */
    const USER_APPLICATION_TYPE_WRONG = 3010;

    /**
     * @Message("您正在视频通话中！")
     */
    const USER_IN_VIDEO_CALL = 3011;

    /**
     * @Message("Friend group creation failed !")
     */
    const FRIEND_GROUP_CREATE_FAIL = 4001;

    /**
     * @Message("Friend group not found !")
     */
    const FRIEND_GROUP_NOT_FOUND = 4002;

    /**
     * @Message("Friend not found!")
     */
    const FRIEND_NOT_FOUND = 4003;

    /**
     * @Message("You can't add yourself as a friend !")
     */
    const FRIEND_NOT_ADD_SELF = 4004;

    /**
     * @Message("You're already friends !")
     */
    const FRIEND_RELATION_ALREADY = 4005;

    /**
     * @Message("对方正在视频通话中")
     */
    const FRIEND_CALL_IN_PROGRESS = 4006;

    /**
     * @Message("There are friends under this group that cannot be deleted !")
     */
    const FRIEND_GROUP_CAN_NOT_DELETE = 4007;

    /**
     * @Message("Group creation failed !'")
     */
    const FRIEND_RELATION_NOT_FOUND = 4008;

    /**
     * @Message("Group not found !")
     */
    const GROUP_CREATE_FAIL = 5001;

    /**
     * @Message("Group relation creation failed !")
     */
    const GROUP_NOT_FOUND = 5002;

    /**
     * @Message("You're already a member of the group !")
     */
    const GROUP_RELATION_CREATE_FAIL = 5010;

    /**
     * @Message("Group full !")
     */
    const GROUP_RELATION_ALREADY = 5011;

    /**
     * @Message("You are not a member of this group !")
     */
    const GROUP_FULL = 5012;

    /**
     * @Message("No friends found !")
     */
    const GROUP_NOT_MEMBER = 5013;


    // ext 9000~9999
    /**
     * @Message("The private key is invalid !")
     */
    const JWT_PRIVATE_KEY_EMPTY = 9001;

    /**
     * @Message("The public key is invalid !")
     */
    const JWT_PUBLIC_KEY_EMPTY = 9002;

    /**
     * @Message("The alg is invalid !")
     */
    const JWT_ALG_EMPTY = 9003;

    /**
     * @Message("Configuration not found !")
     */
    const CONFIG_NOT_FOUND = 9005;

    /**
     * @Message("File does not exist !")
     */
    const FILE_DOES_NOT_EXIST = 9006;

    /**
     * @Message("AliYun mail config not found !")
     */
    const ERR_ALI_MAIL_CONFIG = 9007;

    /**
     * @Message("Mail sending limit !)
     */
    const MAIL_SENDING_LIMIT = 9008;

    /**
     * @Message("Mail send fail !")
     */
    const MAIL_SEND_FAIL = 9009;

    /**
     * @Message("Verification code error !")
     */
    const VERIFY_CODE_ERROR = 9010;

    /**
     * @Message("Verification code is invalid !")
     */
    const VERIFY_CODE_IS_INVALID = 9011;

    /**
     * @Message("Verification code used !")
     */
    const VERiFY_CODE_USED = 9012;
}

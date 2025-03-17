<?php

namespace App\Enums;

enum PermissionEnum: string
{
    // General Permissions
    case VIEW_DASHBOARD = 'VIEW DASHBOARD';

    // Language Permissions
    case VIEW_ANY_LANGUAGES = 'VIEW ANY LANGUAGES';
    case VIEW_LANGUAGE = 'VIEW LANGUAGE';
    case CREATE_LANGUAGE = 'CREATE LANGUAGE';
    case UPDATE_LANGUAGE = 'UPDATE LANGUAGE';
    case DELETE_LANGUAGE = 'DELETE LANGUAGE';
    case RESTORE_LANGUAGE = 'RESTORE LANGUAGE';
    case FORCE_DELETE_LANGUAGE = 'FORCE DELETE LANGUAGE';
}

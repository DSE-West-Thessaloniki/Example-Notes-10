/**
 * This file is auto generated using 'php artisan typescript:generate'
 *
 * Changes to this file will be lost when the command is run again
 */

declare namespace App.Models {
    export interface Note {
        id: number;
        title: string;
        content: string;
        created_at: string | null;
        updated_at: string | null;
        user_id: number;
        user?: App.Models.User | null;
    }

    export interface User {
        id: number;
        username: string;
        name: string;
        email: string;
        email_verified_at: string | null;
        password: string;
        two_factor_secret: string | null;
        two_factor_recovery_codes: string | null;
        two_factor_confirmed_at: string | null;
        remember_token: string | null;
        current_team_id: number | null;
        profile_photo_path: string | null;
        created_at: string | null;
        updated_at: string | null;
        notes?: Array<App.Models.Note> | null;
        notes_count?: number | null;
    }

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('category', ['kecil', 'menengah', 'besar'])->nullable()->after('film_production');
        });

        // Update existing users with categories based on their printing_line_total
        $this->updateExistingUsersCategory();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }

    /**
     * Update existing users with categories based on printing_line_total
     */
    private function updateExistingUsersCategory()
    {
        $users = \App\Models\User::all();

        foreach ($users as $user) {
            if (!empty($user->printing_line_total)) {
                if ($user->printing_line_total === '1 - 3') {
                    $user->category = 'kecil';
                } elseif ($user->printing_line_total === '4 - 6') {
                    $user->category = 'menengah';
                } elseif ($user->printing_line_total === '≥ 7') {
                    $user->category = 'besar';
                }

                $user->save();
            }
        }
    }
};
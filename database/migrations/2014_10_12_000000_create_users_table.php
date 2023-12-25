<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string('name');
           // $table->string('email')->unique();
            $table->string('email')->unique();
            $table->string('avatar')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string("Bio")->nullable(true);
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->boolean('admin')->default(false);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        // Schema::table('users', function (Blueprint $table) {
        //     $table->dropUnique('users_email_unique');
        //     $table->unique('email');
        // });

        
    
    }

//     public function down()
// {
//     // Delete all records from the users table
//     DB::table('users')->delete();

//     Schema::dropIfExists('users');
//     Schema::table('users', function (Blueprint $table) {
//         $table->dropUnique('users_email_unique');
//         $table->unique('email');
//     });
// }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCampaignidToEmailTemplates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
 public function up()
    {
        Schema::table('email_templates',function(Blueprint $table){        
            $table->integer('campaign_id')->nullable()->unsigned();
             $table->foreign('campaign_id')->references('id')->on('campaign')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('email_templates', function(Blueprint $table){
             $table->dropColumn('campaign_id');
        });
    }
}

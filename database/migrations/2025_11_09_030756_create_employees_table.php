<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

            // 從 VP 驗證取得的資料
            $table->string('vp_transaction_id')->unique()->comment('VP 驗證交易 ID');
            $table->string('employee_id', 6)->unique()->comment('員工編號（6位流水號）');

            // 中華民國數位身分證資料
            $table->string('name')->comment('姓名');
            $table->string('id_number', 10)->unique()->comment('國民身分證統一編號');
            $table->string('roc_birthday', 7)->comment('民國出生年月日');
            $table->string('registered_address')->comment('戶籍地址');

            // 教育部數位學位證書資料
            $table->string('student_id')->nullable()->comment('學號');
            $table->string('degree_name')->nullable()->comment('學位名稱');
            $table->string('degree_level')->nullable()->comment('學位層級');
            $table->string('major')->nullable()->comment('主修科系');
            $table->date('graduation_date')->nullable()->comment('畢業日期');
            $table->string('education_institution')->nullable()->comment('畢業學校');

            // 多益英文檢定證書資料
            $table->string('test_name')->nullable()->comment('測驗名稱');
            $table->date('test_date')->nullable()->comment('測驗日期');
            $table->integer('score_listening')->nullable()->comment('聽力分數');
            $table->integer('score_reading')->nullable()->comment('閱讀分數');
            $table->integer('score_total')->nullable()->comment('總分數');
            $table->string('toeic_institution')->nullable()->comment('多益發證單位');

            // 員工資料
            $table->string('position')->default('Cabin Crew')->comment('職位');
            $table->string('department')->default('Cabin Crew')->comment('部門');
            $table->date('employment_start_date')->comment('到職日期');
            $table->string('company_name')->default('臺灣航空')->comment('公司名稱');

            // 員工證 VC 資料
            $table->string('employee_vc_transaction_id')->nullable()->comment('員工證 VC 交易 ID');
            $table->string('employee_vc_cid')->nullable()->comment('員工證 VC 的 CID');
            $table->timestamp('employee_vc_issued_at')->nullable()->comment('員工證發行時間');

            // 登入驗證
            $table->boolean('is_verified')->default(false)->comment('是否已驗證員工證');
            $table->timestamp('last_verified_at')->nullable()->comment('最後驗證時間');

            $table->timestamps();

            // 索引
            $table->index('vp_transaction_id');
            $table->index('employee_id');
            $table->index('id_number');
            $table->index('is_verified');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};

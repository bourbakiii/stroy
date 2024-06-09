<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        DB::statement("
            CREATE TABLE buildings (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                address VARCHAR(255) NOT NULL,
                description VARCHAR(255) NULL,
                due_to DATE NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )
        ");

        DB::statement("
            CREATE TABLE trigger_logs (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                trigger_name VARCHAR(255) NOT NULL,
                trigger_type VARCHAR(50) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
        ");

        DB::statement("
            CREATE TRIGGER buildings_trigger_insert
            AFTER INSERT ON buildings
            FOR EACH ROW
            BEGIN
                INSERT INTO trigger_logs (trigger_name, trigger_type) VALUES ('buildings_trigger_insert', 'AFTER INSERT');
            END
        ");

        DB::statement("
            CREATE TRIGGER buildings_trigger_update
            AFTER UPDATE ON buildings
            FOR EACH ROW
            BEGIN
                INSERT INTO trigger_logs (trigger_name, trigger_type) VALUES ('buildings_trigger_update', 'AFTER UPDATE');
            END
        ");

        DB::statement("
            CREATE TRIGGER buildings_trigger_delete
            AFTER DELETE ON buildings
            FOR EACH ROW
            BEGIN
                INSERT INTO trigger_logs (trigger_name, trigger_type) VALUES ('buildings_trigger_delete', 'AFTER DELETE');
            END
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP TABLE IF EXISTS buildings");
        DB::statement("DROP TABLE IF EXISTS trigger_logs");
    }
};

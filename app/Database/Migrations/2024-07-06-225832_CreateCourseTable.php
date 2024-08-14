<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCourseTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'course_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'description' => [
                'type' => 'TEXT',
            ],
            'rating' => [
                'type' => 'DECIMAL',
                'constraint' => '3,2',
                'default' => 0.0,
            ],
            'rating_count' => [
                'type' => 'INT',
                'default' => 0,
            ],
            'instructor_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00,
            ],
            'duration' => [
                'type' => 'INT',
                'default' => 0,
            ],
            'language' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'enrollment_count' => [
                'type' => 'INT',
                'default' => 0,
            ],
            'uploaded_date' => [
                'type' => 'DATE',
            ],
            'requirements' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'skills_acquired' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'course_image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'modules' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'features' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'compact_content' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'detailed_content' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('course_id', true);
        $this->forge->addForeignKey('instructor_id', 'instructors', 'instructor_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('courses');
    }

    public function down()
    {
        $this->forge->dropTable('courses');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompleteOutputHubSchema extends Migration
{
    public function up()
    {
        // Users table
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        // API Keys table
        Schema::create('api_keys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('key')->unique();
            $table->string('name');
            $table->timestamp('last_used_at')->nullable();
            $table->timestamps();
        });

        // Lookup tables
        $this->createLookupTables();

        // Main tables
        $this->createMainTables();

        // Pivot tables
        $this->createPivotTables();

        // New tables
        $this->createNewTables();
    }

    private function createLookupTables()
    {
        $lookupTables = [
            'lookup_actionability', 'lookup_urgency', 'lookup_status', 'lookup_compliance_standards',
            'lookup_backup_statuses', 'lookup_creation_account', 'lookup_gpt_groups',
            'lookup_data_retention_plans', 'lookup_followup_activities', 'lookup_gpt_tasks',
            'lookup_gpt_capabilities', 'lookup_llm_models', 'lookup_knowledge_types',
            'lookup_programming_languages', 'lookup_human_languages', 'lookup_use_cases',
            'lookup_prompteng_techniques', 'lookup_accuracy_levels', 'lookup_world_countries'
        ];

        foreach ($lookupTables as $tableName) {
            Schema::create($tableName, function (Blueprint $table) use ($tableName) {
                $table->id();
                $table->string('name');
                $table->text('description')->nullable();
                $table->timestamps();

                if (in_array($tableName, ['lookup_tags', 'lookup_categories', 'lookup_projects'])) {
                    $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
                }

                if ($tableName == 'lookup_world_countries') {
                    $table->string('continent')->nullable();
                }
            });
        }
    }

    private function createMainTables()
    {
        // Prompt Outputs table
        Schema::create('prompt_outputs', function (Blueprint $table) {
            $table->id();
            $table->text('summary');
            $table->longText('output_text');
            $table->boolean('output_edited')->default(false);
            $table->text('output_notes')->nullable();
            $table->foreignId('actionability_id')->constrained('lookup_actionability');
            $table->foreignId('urgency_id')->constrained('lookup_urgency');
            $table->foreignId('status_id')->constrained('lookup_status');
            $table->foreignId('compliance_standard_id')->constrained('lookup_compliance_standards');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // Custom GPTs table
        Schema::create('custom_gpts', function (Blueprint $table) {
            $table->id();
            $table->text('summary');
            $table->string('gpt_name');
            $table->date('creation_date');
            $table->text('use_case');
            $table->text('known_limitations')->nullable();
            $table->text('gpt_notes')->nullable();
            $table->foreignId('backup_status_id')->constrained('lookup_backup_statuses');
            $table->foreignId('creation_account_id')->constrained('lookup_creation_account');
            $table->foreignId('status_id')->constrained('lookup_status');
            $table->foreignId('compliance_standard_id')->constrained('lookup_compliance_standards');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // Prompt Library table
        Schema::create('prompt_library', function (Blueprint $table) {
            $table->id();
            $table->string('prompt_short');
            $table->text('prompt_full_text');
            $table->text('prompt_description')->nullable();
            $table->text('prompt_use_case')->nullable();
            $table->foreignId('backup_status_id')->constrained('lookup_backup_statuses');
            $table->foreignId('status_id')->constrained('lookup_status');
            $table->foreignId('compliance_standard_id')->constrained('lookup_compliance_standards');
            $table->foreignId('urgency_id')->constrained('lookup_urgency');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('version')->default(1);
            $table->timestamps();
        });
    }

    private function createPivotTables()
    {
        $pivotTables = [
            'custom_gpt_prompt_output', 'prompt_output_prompt_library', 'prompt_output_tag',
            'prompt_output_llm_model', 'prompt_output_data_retention_plan',
            'prompt_output_followup_activity', 'prompt_output_capability', 'prompt_output_project',
            'prompt_output_category', 'prompt_output_world_country', 'prompt_output_knowledge_type',
            'prompt_output_prompteng_technique', 'prompt_output_accuracy_level',
            'custom_gpt_prompt_library', 'custom_gpt_tag', 'custom_gpt_llm_model',
            'custom_gpt_data_retention_plan', 'custom_gpt_followup_activity', 'custom_gpt_capability',
            'custom_gpt_project', 'custom_gpt_category', 'custom_gpt_world_country',
            'custom_gpt_knowledge_type', 'custom_gpt_prompteng_technique',
            'custom_gpt_programming_language', 'custom_gpt_human_language', 'custom_gpt_task',
            'custom_gpt_group', 'custom_gpt_use_case', 'custom_gpt_accuracy_level',
            'prompt_library_tag', 'prompt_library_llm_model', 'prompt_library_data_retention_plan',
            'prompt_library_followup_activity', 'prompt_library_capability', 'prompt_library_project',
            'prompt_library_category', 'prompt_library_world_country', 'prompt_library_knowledge_type',
            'prompt_library_prompteng_technique', 'prompt_library_programming_language',
            'prompt_library_human_language', 'prompt_library_use_case', 'prompt_library_accuracy_level'
        ];

        foreach ($pivotTables as $tableName) {
            Schema::create($tableName, function (Blueprint $table) use ($tableName) {
                $table->id();
                $parts = explode('_', $tableName);
                $firstModel = Str::singular($parts[0]);
                $secondModel = Str::singular(implode('_', array_slice($parts, -2)));
                
                $table->foreignId("{$firstModel}_id")->constrained()->onDelete('cascade');
                $table->foreignId("{$secondModel}_id")->constrained()->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    private function createNewTables()
    {
        // Prompt Versions table
        Schema::create('prompt_versions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prompt_library_id')->constrained()->onDelete('cascade');
            $table->integer('version_number');
            $table->text('prompt_text');
            $table->text('change_notes')->nullable();
            $table->timestamps();
        });

        // Collaborations table
        Schema::create('collaborations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->morphs('collaboratable');
            $table->string('role');
            $table->timestamps();
        });

        // Activity Log table
        Schema::create('activity_log', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->morphs('loggable');
            $table->string('action');
            $table->text('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        $allTables = [
            'activity_log', 'collaborations', 'prompt_versions', 'api_keys',
            'custom_gpt_prompt_output', 'prompt_output_prompt_library', 'prompt_output_tag',
            'prompt_output_llm_model', 'prompt_output_data_retention_plan',
            'prompt_output_followup_activity', 'prompt_output_capability', 'prompt_output_project',
            'prompt_output_category', 'prompt_output_world_country', 'prompt_output_knowledge_type',
            'prompt_output_prompteng_technique', 'prompt_output_accuracy_level',
            'custom_gpt_prompt_library', 'custom_gpt_tag', 'custom_gpt_llm_model',
            'custom_gpt_data_retention_plan', 'custom_gpt_followup_activity', 'custom_gpt_capability',
            'custom_gpt_project', 'custom_gpt_category', 'custom_gpt_world_country',
            'custom_gpt_knowledge_type', 'custom_gpt_prompteng_technique',
            'custom_gpt_programming_language', 'custom_gpt_human_language', 'custom_gpt_task',
            'custom_gpt_group', 'custom_gpt_use_case', 'custom_gpt_accuracy_level',
            'prompt_library_tag', 'prompt_library_llm_model', 'prompt_library_data_retention_plan',
            'prompt_library_followup_activity', 'prompt_library_capability', 'prompt_library_project',
            'prompt_library_category', 'prompt_library_world_country', 'prompt_library_knowledge_type',
            'prompt_library_prompteng_technique', 'prompt_library_programming_language',
            'prompt_library_human_language', 'prompt_library_use_case', 'prompt_library_accuracy_level',
            'prompt_outputs', 'custom_gpts', 'prompt_library',
            'lookup_actionability', 'lookup_urgency', 'lookup_status', 'lookup_compliance_standards',
            'lookup_backup_statuses', 'lookup_creation_account', 'lookup_gpt_groups',
            'lookup_data_retention_plans', 'lookup_followup_activities', 'lookup_tags',
            'lookup_gpt_tasks', 'lookup_gpt_capabilities', 'lookup_llm_models', 'lookup_categories',
            'lookup_knowledge_types', 'lookup_projects', 'lookup_programming_languages',
            'lookup_human_languages', 'lookup_use_cases', 'lookup_prompteng_techniques',
            'lookup_accuracy_levels', 'lookup_world_countries',
            'users'
        ];

        foreach ($allTables as $tableName) {
            Schema::dropIfExists($tableName);
        }
    }
}
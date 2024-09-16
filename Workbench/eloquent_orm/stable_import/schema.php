<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        $this->createLookupTables();
        $this->createMainTables();
        $this->createPivotTables();
    }

    private function createLookupTables()
    {
        Schema::create('lookup_actionability', function (Blueprint $table) {
            $table->id();
            $table->string('actionability_level');
            $table->text('actionability_description');
            $table->timestamps();
        });

        Schema::create('lookup_urgency', function (Blueprint $table) {
            $table->id();
            $table->string('urgency_level');
            $table->text('status_desc');
            $table->timestamps();
        });

        Schema::create('lookup_status', function (Blueprint $table) {
            $table->id();
            $table->string('status_name');
            $table->text('status_desc');
            $table->timestamps();
        });

        Schema::create('lookup_compliance_standards', function (Blueprint $table) {
            $table->id();
            $table->string('standard_name');
            $table->text('standard_desc');
            $table->timestamps();
        });

        Schema::create('lookup_accuracy_levels', function (Blueprint $table) {
            $table->id();
            $table->string('level_name');
            $table->text('level_description');
            $table->timestamps();
        });

        Schema::create('lookup_backup_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status_name');
            $table->text('status_desc');
            $table->timestamps();
        });

        Schema::create('lookup_creation_account', function (Blueprint $table) {
            $table->id();
            $table->string('account_name');
            $table->text('account_desc');
            $table->timestamps();
        });

        Schema::create('lookup_gpt_groups', function (Blueprint $table) {
            $table->id();
            $table->string('group_name');
            $table->text('group_desc');
            $table->timestamps();
        });

        Schema::create('lookup_data_retention_plans', function (Blueprint $table) {
            $table->id();
            $table->string('retention_plan');
            $table->text('plan_desc');
            $table->timestamps();
        });

        Schema::create('lookup_followup_activities', function (Blueprint $table) {
            $table->id();
            $table->string('activity_name');
            $table->text('activity_desc');
            $table->timestamps();
        });

        Schema::create('lookup_tags', function (Blueprint $table) {
            $table->id();
            $table->string('tag_name');
            $table->text('tag_desc');
            $table->timestamps();
        });

        Schema::create('lookup_gpt_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('task_name');
            $table->text('task_desc');
            $table->timestamps();
        });

        Schema::create('lookup_gpt_capabilities', function (Blueprint $table) {
            $table->id();
            $table->string('capability_name');
            $table->text('capability_desc');
            $table->timestamps();
        });

        Schema::create('lookup_llm_models', function (Blueprint $table) {
            $table->id();
            $table->string('model_name');
            $table->text('model_desc');
            $table->date('release_date');
            $table->timestamps();
        });

        Schema::create('lookup_categories', function (Blueprint $table) {
            $table->id();
            $table->string('cat_name');
            $table->text('cat_desc');
            $table->timestamps();
        });

        Schema::create('lookup_knowledge_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('lookup_projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->text('project_desc');
            $table->date('project_start');
            $table->date('project_end')->nullable();
            $table->timestamps();
        });

        Schema::create('lookup_programming_languages', function (Blueprint $table) {
            $table->id();
            $table->string('lang_name');
            $table->text('lang_desc');
            $table->timestamps();
        });

        Schema::create('lookup_human_languages', function (Blueprint $table) {
            $table->id();
            $table->string('lang_name');
            $table->text('lang_desc');
            $table->timestamps();
        });

        Schema::create('lookup_world_countries', function (Blueprint $table) {
            $table->id();
            $table->string('country_name');
            $table->string('continent');
            $table->timestamps();
        });

        Schema::create('lookup_use_cases', function (Blueprint $table) {
            $table->id();
            $table->string('use_case_name');
            $table->text('use_case_desc');
            $table->timestamps();
        });

        Schema::create('lookup_prompteng_techniques', function (Blueprint $table) {
            $table->id();
            $table->string('tech_name');
            $table->text('tech_desc');
            $table->timestamps();
        });
    }
    
    private function createMainTables()
    {
        Schema::create('prompt_outputs', function (Blueprint $table) {
            $table->id();
            $table->text('summary');
            $table->text('output_text');
            $table->boolean('output_edited');
            $table->text('output_notes')->nullable();
            $table->foreignId('actionability_id')->constrained('lookup_actionability');
            $table->foreignId('urgency_id')->constrained('lookup_urgency');
            $table->foreignId('status_id')->constrained('lookup_status');
            $table->foreignId('compliance_standard_id')->constrained('lookup_compliance_standards');
            $table->timestamps();
        });
    
        Schema::create('custom_gpts', function (Blueprint $table) {
            $table->id();
            $table->text('summary');
            $table->string('gpt_name');
            $table->date('creation_date');
            $table->text('use_case')->nullable();
            $table->text('known_limitations')->nullable();
            $table->text('gpt_notes')->nullable();
            $table->foreignId('backup_status_id')->constrained('lookup_backup_statuses');
            $table->foreignId('creation_account_id')->constrained('lookup_creation_account');
            $table->foreignId('status_id')->constrained('lookup_status');
            $table->foreignId('compliance_standard_id')->constrained('lookup_compliance_standards');
            $table->timestamps();
        });
    
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
            $table->timestamps();
        });
    }
    

    private function createPivotTables()
    {
        Schema::create('custom_gpt_prompt_output', function (Blueprint $table) {
            $table->foreignId('custom_gpt_id')->constrained('custom_gpts');
            $table->foreignId('prompt_output_id')->constrained('prompt_outputs');
            $table->primary(['custom_gpt_id', 'prompt_output_id']);
            $table->timestamps();
        });

        Schema::create('prompt_output_prompt_library', function (Blueprint $table) {
            $table->foreignId('prompt_output_id')->constrained('prompt_outputs');
            $table->foreignId('prompt_library_id')->constrained('prompt_library');
            $table->primary(['prompt_output_id', 'prompt_library_id']);
            $table->timestamps();
        });

        Schema::create('prompt_output_tag', function (Blueprint $table) {
            $table->foreignId('prompt_output_id')->constrained('prompt_outputs');
            $table->foreignId('tag_id')->constrained('lookup_tags');
            $table->primary(['prompt_output_id', 'tag_id']);
            $table->timestamps();
        });

        Schema::create('prompt_output_llm_model', function (Blueprint $table) {
            $table->foreignId('prompt_output_id')->constrained('prompt_outputs');
            $table->foreignId('llm_model_id')->constrained('lookup_llm_models');
            $table->primary(['prompt_output_id', 'llm_model_id']);
            $table->timestamps();
        });

        Schema::create('prompt_output_data_retention_plan', function (Blueprint $table) {
            $table->foreignId('prompt_output_id')->constrained('prompt_outputs');
            $table->foreignId('data_retention_plan_id')->constrained('lookup_data_retention_plans');
            $table->primary(['prompt_output_id', 'data_retention_plan_id']);
            $table->timestamps();
        });

        Schema::create('prompt_output_followup_activity', function (Blueprint $table) {
            $table->foreignId('prompt_output_id')->constrained('prompt_outputs');
            $table->foreignId('followup_activity_id')->constrained('lookup_followup_activities');
            $table->primary(['prompt_output_id', 'followup_activity_id']);
            $table->timestamps();
        });

        Schema::create('prompt_output_capability', function (Blueprint $table) {
            $table->foreignId('prompt_output_id')->constrained('prompt_outputs');
            $table->foreignId('capability_id')->constrained('lookup_gpt_capabilities');
            $table->primary(['prompt_output_id', 'capability_id']);
            $table->timestamps();
        });

        Schema::create('prompt_output_project', function (Blueprint $table) {
            $table->foreignId('prompt_output_id')->constrained('prompt_outputs');
            $table->foreignId('project_id')->constrained('lookup_projects');
            $table->primary(['prompt_output_id', 'project_id']);
            $table->timestamps();
        });

        Schema::create('prompt_output_category', function (Blueprint $table) {
            $table->foreignId('prompt_output_id')->constrained('prompt_outputs');
            $table->foreignId('category_id')->constrained('lookup_categories');
            $table->primary(['prompt_output_id', 'category_id']);
            $table->timestamps();
        });

        Schema::create('prompt_output_world_country', function (Blueprint $table) {
            $table->foreignId('prompt_output_id')->constrained('prompt_outputs');
            $table->foreignId('world_country_id')->constrained('lookup_world_countries');
            $table->primary(['prompt_output_id', 'world_country_id']);
            $table->timestamps();
        });

        Schema::create('prompt_output_knowledge_type', function (Blueprint $table) {
            $table->foreignId('prompt_output_id')->constrained('prompt_outputs');
            $table->foreignId('knowledge_type_id')->constrained('lookup_knowledge_types');
            $table->primary(['prompt_output_id', 'knowledge_type_id']);
            $table->timestamps();
        });

        Schema::create('prompt_output_prompteng_technique', function (Blueprint $table) {
            $table->foreignId('prompt_output_id')->constrained('prompt_outputs');
            $table->foreignId('prompteng_technique_id')->constrained('lookup_prompteng_techniques');
            $table->primary(['prompt_output_id', 'prompteng_technique_id']);
            $table->timestamps();
        });

        Schema::create('prompt_output_accuracy_level', function (Blueprint $table) {
            $table->foreignId('prompt_output_id')->constrained('prompt_outputs');
            $table->foreignId('accuracy_level_id')->constrained('lookup_accuracy_levels');
            $table->primary(['prompt_output_id', 'accuracy_level_id']);
            $table->timestamps();
        });
    }

    public function down()
    {
        // Drop pivot tables
        Schema::dropIfExists('prompt_output_accuracy_level');
        Schema::dropIfExists('prompt_output_prompteng_technique');
        Schema::dropIfExists('prompt_output_knowledge_type');
        Schema::dropIfExists('prompt_output_world_country');
        Schema::dropIfExists('prompt_output_category');
        Schema::dropIfExists('prompt_output_project');
        Schema::dropIfExists('prompt_output_capability');
        Schema::dropIfExists('prompt_output_followup_activity');
        Schema::dropIfExists('prompt_output_data_retention_plan');
        Schema::dropIfExists('prompt_output_llm_model');
        Schema::dropIfExists('prompt_output_tag');
        Schema::dropIfExists('prompt_output_prompt_library');
        Schema::dropIfExists('custom_gpt_prompt_output');

        // Drop main tables
        Schema::dropIfExists('prompt_outputs');
        Schema::dropIfExists('custom_gpts');
        Schema::dropIfExists('prompt_library');

        // Drop lookup tables
        Schema::dropIfExists('lookup_actionability');
        Schema::dropIfExists('lookup_urgency');
        Schema::dropIfExists('lookup_status');
        Schema::dropIfExists('lookup_compliance_standards');
        Schema::dropIfExists('lookup_accuracy_levels');
        Schema::dropIfExists('lookup_backup_statuses');
        Schema::dropIfExists('lookup_creation_account');
        Schema::dropIfExists('lookup_gpt_groups');
        Schema::dropIfExists('lookup_data_retention_plans');
        Schema::dropIfExists('lookup_followup_activities');
        Schema::dropIfExists('lookup_tags');
        Schema::dropIfExists('lookup_gpt_tasks');
        Schema::dropIfExists('lookup_gpt_capabilities');
        Schema::dropIfExists('lookup_llm_models');
        Schema::dropIfExists('lookup_categories');
        Schema::dropIfExists('lookup_knowledge_types');
        Schema::dropIfExists('lookup_projects');
        Schema::dropIfExists('lookup_programming_languages');
        Schema::dropIfExists('lookup_human_languages');
        Schema::dropIfExists('lookup_world_countries');
        Schema::dropIfExists('lookup_use_cases');
        Schema::dropIfExists('lookup_prompteng_techniques');
    }
};

### Database Schema Definition for Laravel Nova

Assume that each table should include an `id` column, which is an autoincrementing integer serving as the primary key unless otherwise specified. If a data type is not explicitly mentioned, assume it should be `text`. When numbers are stored, assume they are whole numbers (`integer`) without decimal places. Relationships are specified, with explicit mention of pivot tables for M2M relationships.

---

#### Tables and Relationships

1. **prompt_outputs**
   - **Fields:**
     - `id`: Primary Key, Autoincrementing Integer
     - `summary`: Text
     - `output_text`: Text
     - `created_at`: Date
     - `output_edited`: Boolean
     - `output_notes`: Text
     - `actionability_id`: Foreign Key to `lookup_actionability(id)`
     - `urgency_id`: Foreign Key to `lookup_urgency(id)`
     - `status_id`: Foreign Key to `lookup_status(id)`
     - `compliance_standard_id`: Foreign Key to `lookup_compliance_standards(id)`

   - **Relationships:**
     - **M2M with `custom_gpts` via `custom_gpt_prompt_output`**
     - **M2M with `prompt_library` via `prompt_output_prompt_library`**
     - **M2M with `lookup_tags` via `prompt_output_tag`**
     - **M2M with `lookup_llm_models` via `prompt_output_llm_model`**
     - **M2M with `lookup_data_retention_plans` via `prompt_output_data_retention_plan`**
     - **M2M with `lookup_followup_activities` via `prompt_output_followup_activity`**
     - **M2M with `lookup_capabilities` via `prompt_output_capability`**
     - **M2M with `lookup_projects` via `prompt_output_project`**
     - **M2M with `lookup_categories` via `prompt_output_category`**
     - **M2M with `lookup_world_countries` via `prompt_output_world_country`**
     - **M2M with `lookup_knowledge_types` via `prompt_output_knowledge_type`**
     - **M2M with `lookup_prompteng_techniques` via `prompt_output_prompteng_technique`**
     - **M2M with `lookup_accuracy_levels` via `prompt_output_accuracy_level`**
     - **O2M with `lookup_actionability`**
     - **O2M with `lookup_urgency`**
     - **O2M with `lookup_status`**

2. **custom_gpts**
   - **Fields:**
     - `id`: Primary Key, Autoincrementing Integer
     - `summary`: Text
     - `gpt_name`: Text
     - `creation_date`: Date
     - `use_case`: Text
     - `known_limitations`: Text
     - `gpt_notes`: Text
     - `backup_status_id`: Foreign Key to `lookup_backup_statuses(id)`
     - `creation_account_id`: Foreign Key to `lookup_creation_account(id)`
     - `status_id`: Foreign Key to `lookup_status(id)`
     - `compliance_standard_id`: Foreign Key to `lookup_compliance_standards(id)`

   - **Relationships:**
     - **M2M with `prompt_library` via `custom_gpt_prompt_library`**
     - **M2M with `lookup_tags` via `custom_gpt_tag`**
     - **M2M with `lookup_llm_models` via `custom_gpt_llm_model`**
     - **M2M with `lookup_data_retention_plans` via `custom_gpt_data_retention_plan`**
     - **M2M with `lookup_followup_activities` via `custom_gpt_followup_activity`**
     - **M2M with `lookup_capabilities` via `custom_gpt_capability`**
     - **M2M with `lookup_projects` via `custom_gpt_project`**
     - **M2M with `lookup_categories` via `custom_gpt_category`**
     - **M2M with `lookup_world_countries` via `custom_gpt_world_country`**
     - **M2M with `lookup_knowledge_types` via `custom_gpt_knowledge_type`**
     - **M2M with `lookup_prompteng_techniques` via `custom_gpt_prompteng_technique`**
     - **M2M with `lookup_programming_languages` via `custom_gpt_programming_language`**
     - **M2M with `lookup_human_languages` via `custom_gpt_human_language`**
     - **M2M with `lookup_gpt_tasks` via `custom_gpt_task`**
     - **M2M with `lookup_gpt_groups` via `custom_gpt_group`**
     - **M2M with `lookup_use_cases` via `custom_gpt_use_case`**
     - **M2M with `lookup_accuracy_levels` via `custom_gpt_accuracy_level`**

3. **prompt_library**
   - **Fields:**
     - `id`: Primary Key, Autoincrementing Integer
     - `prompt_short`: Text
     - `prompt_full_text`: Text
     - `prompt_description`: Text
     - `prompt_use_case`: Text
     - `backup_status_id`: Foreign Key to `lookup_backup_statuses(id)`
     - `status_id`: Foreign Key to `lookup_status(id)`
     - `compliance_standard_id`: Foreign Key to `lookup_compliance_standards(id)`
     - `urgency_id`: Foreign Key to `lookup_urgency(id)`

   - **Relationships:**
     - **M2M with `lookup_tags` via `prompt_library_tag`**
     - **M2M with `lookup_llm_models` via `prompt_library_llm_model`**
     - **M2M with `lookup_data_retention_plans` via `prompt_library_data_retention_plan`**
     - **M2M with `lookup_followup_activities` via `prompt_library_followup_activity`**
     - **M2M with `lookup_capabilities` via `prompt_library_capability`**
     - **M2M with `lookup_projects` via `prompt_library_project`**
     - **M2M with `lookup_categories` via `prompt_library_category`**
     - **M2M with `lookup_world_countries` via `prompt_library_world_country`**
     - **M2M with `lookup_knowledge_types` via `prompt_library_knowledge_type`**
     - **M2M with `lookup_prompteng_techniques` via `prompt_library_prompteng_technique`**
     - **M2M with `lookup_programming_languages` via `prompt_library_programming_language`**
     - **M2M with `lookup_human_languages` via `prompt_library_human_language`**
     - **M2M with `lookup_use_cases` via `prompt_library_use_case`**
     - **M2M with `lookup_accuracy_levels` via `prompt_library_accuracy_level`

4. **lookup_accuracylevels**
   - **Fields:**
     - `id`: Primary Key, Autoincrementing Integer
     - `level_name`: Text
     - `level_description`: Text

   - **Relationships:**
     - **M2M with `custom_gpts` via `custom_gpt_accuracy_level`**
     - **M2M with `prompt_library` via `prompt_library_accuracy_level`**
     - **M2M with `prompt_outputs` via `prompt_output_accuracy_level`**

5. **lookup_actionability**
   - **Fields:**
     - `id`: Primary Key, Autoincrementing Integer
     - `actionability_level`: Text
     - `actionability_description`: Text

   - **Relationships:**
     - **O2M with `prompt_outputs`**

6. **lookup_backup_statuses**
   - **Fields:**
     - `id`: Primary Key, Autoincrementing Integer
     - `status_name`: Text
     - `status_desc`: Text

   - **Relationships:**
     - **O2M with `custom_gpts`**
     - **O2M with `prompt_library`**
     - **O2M with `prompt_outputs`**

7. **lookup_creation_account**
   - **Fields:**
     - `id`: Primary Key, Autoincrementing Integer
     - `account_name`: Text
     - `account_desc`: Text

   - **Relationships:**
     - **O2M with `custom_gpts`**

8. **lookup_gpt_groups**
   - **Fields:**
     - `id`: Primary Key, Autoincrementing Integer
     - `group_name`: Text
     - `group_desc`: Text

   - **Relationships:**
     - **M2M with `custom_gpts` via `custom_gpt_group`**

9. **lookup_data_retention_plans**
   - **Fields:**
     - `id`: Primary Key, Autoincrementing Integer
     - `retention_plan`: Text
     - `plan_desc`: Text

   - **Relationships:**
     - **M2M with `custom_gpts` via `custom_gpt_data_retention_plan`**
     - **M2M with `prompt_outputs` via `prompt_output_data_retention_plan`**
     - **M2M with `prompt_library` via `prompt_library_data_retention_plan`**

10. **lookup_followup_activities**
    - **Fields:**
      - `id`: Primary Key, Autoincrementing Integer
      - `activity_name`: Text
      - `activity_desc`: Text

    - **Relationships:**
      - **M2M with `custom_gpts` via `custom_gpt_followup_activity`**
      - **M2M with `prompt_library` via `prompt_library_followup_activity`**
      - **M2M with `prompt_outputs` via `prompt_output_followup_activity`**

11. **lookup_tags**
    - **Fields:**
      - `id`: Primary Key, Autoincrementing Integer
      - `tag_name`: Text
      - `tag_desc`: Text
      - `created_at`: Date

    - **Relationships:**
      - **M2M with `custom_gpts` via `custom_gpt_tag`**
      - **M2M with `prompt_library` via `prompt_library_tag`**
      - **M2M with `prompt_outputs` via `prompt_output_tag`**

12. **lookup_gpt_tasks**
    - **Fields:**
      - `id`: Primary Key, Autoincrementing Integer
      - `task_name`: Text
      - `task_desc`: Text

    - **Relationships:**
      - **M2M with `custom_gpts` via `custom_gpt_task`**

13. **lookup_gpt_capabilities**
    - **Fields:**
      - `id`: Primary Key, Autoincrementing Integer
      - `capability_name`: Text
      - `capability_desc`: Text

    - **Relationships:**
      - **M2M with `custom_gpts` via `custom_gpt_capability`**
      - **M2M with `prompt_outputs` via `prompt_output_capability`**

14. **lookup_llm_models**
    - **Fields:**
      - `id`: Primary Key, Autoincrementing Integer
      - `model_name`: Text
      - `model_desc`: Text
      - `release_date`: Date

    - **Relationships:**
      - **M2M with `custom_gpts` via `custom_gpt_llm_model`**
      - **M2M with `prompt_library` via `prompt_library_llm_model`**
      - **M2M with `prompt_outputs` via `prompt_output_llm_model`**

15. **lookup_categories**
    - **Fields:**
      - `id`: Primary Key, Autoincrementing Integer
      - `cat_name`: Text
      - `cat_desc`: Text
      - `created_at`: Date

    - **Relationships:**
      - **M2M with `custom_gpts` via `custom_gpt_category`**
      - **M2M with `prompt_library` via `prompt_library_category`**
      - **M2M with `prompt_outputs` via `prompt_output_category`**

16. **lookup_knowledge_types**
    - **Fields:**
      - `id`: Primary Key, Autoincrementing Integer
      - `name`: Text
      - `description`: Text

    - **Relationships:**
      - **M2M with `custom_gpts` via `custom_gpt_knowledge_type`**
      - **M2M with `prompt_outputs` via `prompt_output_knowledge_type`**

17. **lookup_projects**
    - **Fields:**
      - `id`: Primary Key, Autoincrementing Integer
      - `project_name`: Text
      - `project_desc`: Text
      - `project_start`: Date
      - `project_end`: Date

    - **Relationships:**
      - **M2M with `custom_gpts` via `custom_gpt_project`**
      - **M2M with `prompt_library` via `prompt_library_project`**
      - **M2M with `prompt_outputs` via `prompt_output_project`**

18. **lookup_status**
    - **Fields:**
      - `id`: Primary Key, Autoincrementing Integer
      - `status_name`: Text
      - `status_desc`: Text

    - **Relationships:**
      - **O2M with `prompt_outputs`**
      - **O2M with `custom_gpts`**
      - **O2M with `prompt_library`**

19. **lookup_programming_languages**
    - **Fields:**
      - `id`: Primary Key, Autoincrementing Integer
      - `lang_name`: Text
      - `lang_desc`: Text

    - **Relationships:**
      - **M2M with `custom_gpts` via `custom_gpt_programming_language`**
      - **M2M with `prompt_library` via `prompt_library_programming_language`**
      - **M2M with `prompt_outputs` via `prompt_output_programming_language`**

20. **lookup_human_languages**
    - **Fields:**
      - `id`: Primary Key, Autoincrementing Integer
      - `lang_name`: Text
      - `lang_desc`: Text

    - **Relationships:**
      - **M2M with `custom_gpts` via `custom_gpt_human_language`**
      - **M2M with `prompt_library` via `prompt_library_human_language`**
      - **M2M with `prompt_outputs` via `prompt_output_human_language`**

21. **lookup_urgency**
    - **Fields:**
      - `id`: Primary Key, Autoincrementing Integer
      - `urgency_level`: Text
      - `status_desc`: Text

    - **Relationships:**
      - **O2M with `prompt_outputs`**
      - **O2M with `prompt_library`**

22. **lookup_world_countries**
    - **Fields:**
      - `id`: Primary Key, Autoincrementing Integer
      - `country_name`: Text
      - `continent`: Text

    - **Relationships:**
      - **M2M with `custom_gpts` via `custom_gpt_world_country`**
      - **M2M with `prompt_library` via `prompt_library_world_country`**
      - **M2M with `prompt_outputs` via `prompt_output_world_country`**

23. **lookup_use_cases**
    - **Fields:**
      - `id`: Primary Key, Autoincrementing Integer
      - `use_case_name`: Text
      - `use_case_desc`: Text

    - **Relationships:**
      - **M2M with `custom_gpts` via `custom_gpt_use_case`**
      - **M2M with `prompt_library` via `prompt_library_use_case`**
      - **M2M with `prompt_outputs` via `prompt_output_use_case`**

24. **lookup_prompteng_techniques**
    - **Fields:**
      - `id`: Primary Key, Autoincrementing Integer
      - `tech_name`: Text
      - `tech_desc`: Text

    - **Relationships:**
      - **M2M with `custom_gpts` via `custom_gpt_prompteng_technique`**
      - **M2M with `prompt_library` via `prompt_library_prompteng_technique`**
      - **M2M with `prompt_outputs` via `prompt_output_prompteng_technique`**

25. **lookup_compliance_standards**
    - **Fields:**
      - `id`: Primary Key, Autoincrementing Integer
      - `standard_name`: Text
      - `standard_desc`: Text

    - **Relationships:**
      - **O2M with `prompt_outputs`**
      - **O2M with `custom_gpts`**
      - **O2M with `prompt_library`**

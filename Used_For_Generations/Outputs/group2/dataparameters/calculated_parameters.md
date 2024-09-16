### Summary of the Database Schema

**Number of Tables:** 25  
**Number of M2M Relationships:** 71  
**Number of O2M Relationships:** 18

### Tables

1. **prompt_outputs**
2. **custom_gpts**
3. **prompt_library**
4. **lookup_accuracy_levels**
5. **lookup_actionability**
6. **lookup_backup_statuses**
7. **lookup_creation_account**
8. **lookup_gpt_groups**
9. **lookup_data_retention_plans**
10. **lookup_followup_activities**
11. **lookup_tags**
12. **lookup_gpt_tasks**
13. **lookup_gpt_capabilities**
14. **lookup_llm_models**
15. **lookup_categories**
16. **lookup_knowledge_types**
17. **lookup_projects**
18. **lookup_status**
19. **lookup_programming_languages**
20. **lookup_human_languages**
21. **lookup_urgency**
22. **lookup_world_countries**
23. **lookup_use_cases**
24. **lookup_prompteng_techniques**
25. **lookup_compliance_standards**

### M2M Relationships

- **prompt_outputs:**
  - custom_gpts via `custom_gpt_prompt_output`
  - prompt_library via `prompt_output_prompt_library`
  - lookup_tags via `prompt_output_tag`
  - lookup_llm_models via `prompt_output_llm_model`
  - lookup_data_retention_plans via `prompt_output_data_retention_plan`
  - lookup_followup_activities via `prompt_output_followup_activity`
  - lookup_capabilities via `prompt_output_capability`
  - lookup_projects via `prompt_output_project`
  - lookup_categories via `prompt_output_category`
  - lookup_world_countries via `prompt_output_world_country`
  - lookup_knowledge_types via `prompt_output_knowledge_type`
  - lookup_prompteng_techniques via `prompt_output_prompteng_technique`
  - lookup_accuracy_levels via `prompt_output_accuracy_level`
  
- **custom_gpts:**
  - prompt_library via `custom_gpt_prompt_library`
  - lookup_tags via `custom_gpt_tag`
  - lookup_llm_models via `custom_gpt_llm_model`
  - lookup_data_retention_plans via `custom_gpt_data_retention_plan`
  - lookup_followup_activities via `custom_gpt_followup_activity`
  - lookup_capabilities via `custom_gpt_capability`
  - lookup_projects via `custom_gpt_project`
  - lookup_categories via `custom_gpt_category`
  - lookup_world_countries via `custom_gpt_world_country`
  - lookup_knowledge_types via `custom_gpt_knowledge_type`
  - lookup_prompteng_techniques via `custom_gpt_prompteng_technique`
  - lookup_programming_languages via `custom_gpt_programming_language`
  - lookup_human_languages via `custom_gpt_human_language`
  - lookup_gpt_tasks via `custom_gpt_task`
  - lookup_gpt_groups via `custom_gpt_group`
  - lookup_use_cases via `custom_gpt_use_case`
  - lookup_accuracy_levels via `custom_gpt_accuracy_level`
  
- **prompt_library:**
  - lookup_tags via `prompt_library_tag`
  - lookup_llm_models via `prompt_library_llm_model`
  - lookup_data_retention_plans via `prompt_library_data_retention_plan`
  - lookup_followup_activities via `prompt_library_followup_activity`
  - lookup_capabilities via `prompt_library_capability`
  - lookup_projects via `prompt_library_project`
  - lookup_categories via `prompt_library_category`
  - lookup_world_countries via `prompt_library_world_country`
  - lookup_knowledge_types via `prompt_library_knowledge_type`
  - lookup_prompteng_techniques via `prompt_library_prompteng_technique`
  - lookup_programming_languages via `prompt_library_programming_language`
  - lookup_human_languages via `prompt_library_human_language`
  - lookup_use_cases via `prompt_library_use_case`
  - lookup_accuracy_levels via `prompt_library_accuracy_level`
  
- **lookup_accuracy_levels:**
  - custom_gpts via `custom_gpt_accuracy_level`
  - prompt_library via `prompt_library_accuracy_level`
  - prompt_outputs via `prompt_output_accuracy_level`
  
- **lookup_data_retention_plans:**
  - custom_gpts via `custom_gpt_data_retention_plan`
  - prompt_outputs via `prompt_output_data_retention_plan`
  - prompt_library via `prompt_library_data_retention_plan`
  
- **lookup_followup_activities:**
  - custom_gpts via `custom_gpt_followup_activity`
  - prompt_library via `prompt_library_followup_activity`
  - prompt_outputs via `prompt_output_followup_activity`
  
- **lookup_tags:**
  - custom_gpts via `custom_gpt_tag`
  - prompt_library via `prompt_library_tag`
  - prompt_outputs via `prompt_output_tag`
  
- **lookup_gpt_tasks:**
  - custom_gpts via `custom_gpt_task`
  
- **lookup_gpt_capabilities:**
  - custom_gpts via `custom_gpt_capability`
  - prompt_outputs via `prompt_output_capability`
  
- **lookup_llm_models:**
  - custom_gpts via `custom_gpt_llm_model`
  - prompt_library via `prompt_library_llm_model`
  - prompt_outputs via `prompt_output_llm_model`
  
- **lookup_categories:**
  - custom_gpts via `custom_gpt_category`
  - prompt_library via `prompt_library_category`
  - prompt_outputs via `prompt_output_category`
  
- **lookup_knowledge_types:**
  - custom_gpts via `custom_gpt_knowledge_type`
  - prompt_outputs via `prompt_output_knowledge_type`
  
- **lookup_projects:**
  - custom_gpts via `custom_gpt_project`
  - prompt_library via `prompt_library_project`
  - prompt_outputs via `prompt_output_project`
  
- **lookup_programming_languages:**
  - custom_gpts via `custom_gpt_programming_language`
  - prompt_library via `prompt_library_programming_language`
  - prompt_outputs via `prompt_output_programming_language`
  
- **lookup_human_languages:**
  - custom_gpts via `custom_gpt_human_language`
  - prompt_library via `prompt_library_human_language`
  - prompt_outputs via `prompt_output_human_language`
  
- **lookup_world_countries:**
  - custom_gpts via `custom_gpt_world_country`
  - prompt_library via `prompt_library_world_country`
  - prompt_outputs via `prompt_output_world_country`
  
- **lookup_use_cases:**
  - custom_gpts via `custom_gpt_use_case`
  - prompt_library via `prompt_library_use_case`
  - prompt_outputs via `prompt_output_use_case`
  
- **lookup_prompteng_techniques:**
  - custom_gpts via `custom_gpt_prompteng_technique`
  - prompt_library via `prompt_library_prompteng_technique`
  - prompt_outputs via `prompt_output_prompteng_technique`

### O2M Relationships

- **prompt_outputs:**
  - lookup_actionability
  - lookup_urgency
  - lookup_status
  - lookup_compliance_standards
  
- **custom_gpts:**
  - lookup_backup_statuses
  - lookup_creation_account
  - lookup_status
  - lookup_compliance_standards
  
- **prompt_library:**
  - lookup_backup_statuses
  - lookup_status
  - lookup_compliance_standards
  - lookup_urgency
  
- **lookup_actionability:**
  - prompt_outputs
  
- **lookup_backup_statuses:**
  - custom_gpts
  - prompt_library
  - prompt_outputs
  
- **lookup_creation_account:**
  - custom_gpts
  
- **lookup_status:**
  - prompt_outputs
  - custom_gpts
  - prompt_library
  
- **lookup_urgency:**
  - prompt_outputs
  - prompt_library
  
- **lookup_compliance_standards:**
  - prompt_outputs
  - custom_gpts
  - prompt_library


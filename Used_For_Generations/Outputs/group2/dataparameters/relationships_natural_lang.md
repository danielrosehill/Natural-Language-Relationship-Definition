The database schema consists of 25 tables, with 71 many-to-many (M2M) relationships and 18 one-to-many (O2M) relationships.

### Tables Overview

There are 25 tables in the database, including:
- **prompt_outputs**
- **custom_gpts**
- **prompt_library**
- **lookup_accuracy_levels**
- **lookup_actionability**
- **lookup_backup_statuses**
- **lookup_creation_account**
- **lookup_gpt_groups**
- **lookup_data_retention_plans**
- **lookup_followup_activities**
- **lookup_tags**
- **lookup_gpt_tasks**
- **lookup_gpt_capabilities**
- **lookup_llm_models**
- **lookup_categories**
- **lookup_knowledge_types**
- **lookup_projects**
- **lookup_status**
- **lookup_programming_languages**
- **lookup_human_languages**
- **lookup_urgency**
- **lookup_world_countries**
- **lookup_use_cases**
- **lookup_prompteng_techniques**
- **lookup_compliance_standards**

### Many-to-Many (M2M) Relationships

Several tables are connected by many-to-many relationships. 

Here are some examples:
- **prompt_outputs** connects with **custom_gpts** through a linking table named `custom_gpt_prompt_output`, and similarly connects with other tables like **prompt_library** and **lookup_tags** via respective linking tables.
- **custom_gpts** has many-to-many links with **prompt_library** through `custom_gpt_prompt_library`, and other tables like **lookup_tags** and **lookup_llm_models**.
- **prompt_library** connects to **lookup_tags** through `prompt_library_tag`, and other tables like **lookup_llm_models** and **lookup_data_retention_plans**.

Each of these relationships is facilitated by an intermediary table (like a pivot table) that connects the two primary tables.

### One-to-Many (O2M) Relationships

Some tables have one-to-many relationships, where one record in a table is related to multiple records in another. 

Examples include:
- **prompt_outputs** connects to **lookup_actionability**, **lookup_urgency**, **lookup_status**, and **lookup_compliance_standards**.
- **custom_gpts** connects to **lookup_backup_statuses**, **lookup_creation_account**, **lookup_status**, and **lookup_compliance_standards**.
- **prompt_library** connects to **lookup_backup_statuses**, **lookup_status**, **lookup_compliance_standards**, and **lookup_urgency**.

In these relationships, each record in the first table can have multiple corresponding records in the second table. For example, a single prompt output can have multiple associated statuses or levels of actionability.


<?php

namespace SoftinCode\StudioApp\Macros;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class BlueprintMacro
{
    public static function register()
    {
        // Macro to set validation rules for a column
        Blueprint::macro('validated', function ($rules) {
            $this->validationRules[$this->name] = $rules;  // Store validation rules per column
            return $this;
        });

        // Macro to save table structure, including validations
        Blueprint::macro('saveStructure', function ($route, $permissionEvent = null) {
            $tableName = $this->getTable();

            // Ensure tableinfo exists before inserting
            if (!Schema::hasTable('tableinfo')) {
                return;
            }

            // Fetch all column definitions
            $columns = Schema::getColumnListing($tableName);
            $structure = ['columns' => [], 'validations' => []];

            foreach ($columns as $column) {
                $structure['columns'][$column] = Schema::getColumnType($tableName, $column);

                // Save validation rules if they exist
                if (isset($this->validationRules[$column])) {
                    $structure['validations'][$column] = $this->validationRules[$column];
                }
            }

            // Convert structure to JSON
            $jsonStructure = json_encode($structure, JSON_PRETTY_PRINT);

            // Insert into tableinfo
            DB::table('tableinfo')->insert([
                '_table'           => $tableName,
                '_route'           => $route,
                '_permissionEvent' => $permissionEvent,
                '_structure'       => $jsonStructure,
                '_created_at'      => now(),
                '_updated_at'      => null,
            ]);
        });
    }
}

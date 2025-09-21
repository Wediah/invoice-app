<?php

namespace App\Services;

use App\Models\Company;

class ProfileCompletionService
{
    protected $company;
    
    public function __construct(Company $company)
    {
        $this->company = $company;
    }
    
    /**
     * Get profile completion data for all categories
     */
    public function getProfileCompletionData()
    {
        return [
            'basic_info' => $this->getBasicInfoCompletion(),
            'advanced_info' => $this->getAdvancedInfoCompletion(),
            'financial_info' => $this->getFinancialInfoCompletion(),
            'settings_preferences' => $this->getSettingsPreferencesCompletion(),
            'overall' => $this->getOverallCompletion()
        ];
    }
    
    /**
     * Calculate basic information completion
     */
    protected function getBasicInfoCompletion()
    {
        $fields = [
            'name' => $this->company->name,
            'email' => $this->company->email,
            'phone' => $this->company->phone,
            'logo' => $this->company->logo,
            'category' => $this->company->company_category_id
        ];
        
        $completed = collect($fields)->filter(function ($value) {
            return !empty($value);
        })->count();
        
        $total = count($fields);
        $percentage = round(($completed / $total) * 100);
        
        return [
            'completed' => $completed,
            'total' => $total,
            'percentage' => $percentage,
            'status' => $this->getStatus($percentage),
            'fields' => $this->getFieldStatus($fields)
        ];
    }
    
    /**
     * Calculate advanced information completion
     */
    protected function getAdvancedInfoCompletion()
    {
        $fields = [
            'registration_number' => $this->company->registration_number,
            'description' => $this->company->description,
            'address' => $this->company->address,
            'website' => $this->company->website,
            'instagram' => $this->company->instagram,
            'twitter' => $this->company->twitter,
            'linkedin' => $this->company->linkedin,
            'facebook' => $this->company->facebook
        ];
        
        $completed = collect($fields)->filter(function ($value) {
            return !empty($value);
        })->count();
        
        $total = count($fields);
        $percentage = round(($completed / $total) * 100);
        
        return [
            'completed' => $completed,
            'total' => $total,
            'percentage' => $percentage,
            'status' => $this->getStatus($percentage),
            'fields' => $this->getFieldStatus($fields)
        ];
    }
    
    /**
     * Calculate financial information completion
     */
    protected function getFinancialInfoCompletion()
    {
        $fields = [
            'tax_identification_number' => $this->company->tax_identification_number,
            'currency' => $this->company->currency,
            'account_number' => $this->company->account_number,
            'bank_name' => $this->company->bank_name,
            'bank_branch' => $this->company->bank_branch,
            'swift_code' => $this->company->swift_code,
            'merchant_network' => $this->company->merchant_network,
            'merchant_number' => $this->company->merchant_number,
            'merchant_id' => $this->company->merchant_id,
            'merchant_name' => $this->company->merchant_name
        ];
        
        $completed = collect($fields)->filter(function ($value) {
            return !empty($value);
        })->count();
        
        $total = count($fields);
        $percentage = round(($completed / $total) * 100);
        
        return [
            'completed' => $completed,
            'total' => $total,
            'percentage' => $percentage,
            'status' => $this->getStatus($percentage),
            'fields' => $this->getFieldStatus($fields)
        ];
    }
    
    /**
     * Calculate settings and preferences completion
     */
    protected function getSettingsPreferencesCompletion()
    {
        $fields = [
            'invoice_prefix' => $this->company->invoice_prefix,
            'invoice_numbering' => $this->company->invoice_numbering,
            'invoice_footnote' => $this->company->invoice_footnote
        ];
        
        $completed = collect($fields)->filter(function ($value) {
            return !empty($value);
        })->count();
        
        $total = count($fields);
        $percentage = round(($completed / $total) * 100);
        
        return [
            'completed' => $completed,
            'total' => $total,
            'percentage' => $percentage,
            'status' => $this->getStatus($percentage),
            'fields' => $this->getFieldStatus($fields)
        ];
    }
    
    /**
     * Calculate overall completion percentage
     */
    protected function getOverallCompletion()
    {
        $categories = [
            $this->getBasicInfoCompletion(),
            $this->getAdvancedInfoCompletion(),
            $this->getFinancialInfoCompletion(),
            $this->getSettingsPreferencesCompletion()
        ];
        
        $totalCompleted = collect($categories)->sum('completed');
        $totalFields = collect($categories)->sum('total');
        
        $percentage = $totalFields > 0 ? round(($totalCompleted / $totalFields) * 100) : 0;
        
        return [
            'completed' => $totalCompleted,
            'total' => $totalFields,
            'percentage' => $percentage,
            'status' => $this->getStatus($percentage)
        ];
    }
    
    /**
     * Get status based on percentage
     */
    protected function getStatus($percentage)
    {
        if ($percentage >= 100) {
            return 'completed';
        } elseif ($percentage >= 75) {
            return 'almost_complete';
        } elseif ($percentage >= 50) {
            return 'in_progress';
        } elseif ($percentage >= 25) {
            return 'started';
        } else {
            return 'not_started';
        }
    }
    
    /**
     * Get field status for each field
     */
    protected function getFieldStatus($fields)
    {
        return collect($fields)->map(function ($value, $key) {
            return [
                'field' => $key,
                'completed' => !empty($value),
                'value' => $value
            ];
        })->toArray();
    }
    
    /**
     * Get completion status text
     */
    public function getStatusText($status)
    {
        $statusTexts = [
            'completed' => 'Completed',
            'almost_complete' => 'Almost Complete',
            'in_progress' => 'In Progress',
            'started' => 'Started',
            'not_started' => 'Not Started'
        ];
        
        return $statusTexts[$status] ?? 'Unknown';
    }
    
    /**
     * Get status color class
     */
    public function getStatusColorClass($status)
    {
        $colors = [
            'completed' => 'success',
            'almost_complete' => 'primary',
            'in_progress' => 'warning',
            'started' => 'info',
            'not_started' => 'secondary'
        ];
        
        return $colors[$status] ?? 'secondary';
    }
    
    /**
     * Get status icon
     */
    public function getStatusIcon($status)
    {
        $icons = [
            'completed' => 'bx-check-circle',
            'almost_complete' => 'bx-check',
            'in_progress' => 'bx-time',
            'started' => 'bx-play-circle',
            'not_started' => 'bx-circle'
        ];
        
        return $icons[$status] ?? 'bx-circle';
    }
}

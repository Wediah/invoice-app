@props(['company'])

@php
    $completionData = $company->getProfileCompletionData();
    $service = new \App\Services\ProfileCompletionService($company);
@endphp

<div class="mb-4 card">
    <h5 class="card-header">
        <i class="bx bx-trending-up me-2"></i>Profile Completion Timeline
        <span class="badge bg-label-{{ $service->getStatusColorClass($completionData['overall']['status']) }} ms-2">
            {{ $completionData['overall']['percentage'] }}% Complete
        </span>
    </h5>
    <div class="card-body">
        <!-- Overall Progress Bar -->
        <div class="mb-4">
            <div class="mb-2 d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Overall Profile Completion</h6>
                <span class="text-muted">{{ $completionData['overall']['completed'] }}/{{ $completionData['overall']['total'] }} fields</span>
            </div>
            <div class="progress" style="height: 8px;">
                <div class="progress-bar bg-{{ $service->getStatusColorClass($completionData['overall']['status']) }}" 
                     role="progressbar" 
                     style="width: {{ $completionData['overall']['percentage'] }}%"
                     aria-valuenow="{{ $completionData['overall']['percentage'] }}" 
                     aria-valuemin="0" 
                     aria-valuemax="100">
                </div>
            </div>
        </div>

        <!-- Timeline -->
        <ul class="timeline">
            @foreach([
                'basic_info' => [
                    'title' => 'Basic Information',
                    'icon' => 'bx-user',
                    'description' => 'Essential company details and contact information'
                ],
                'advanced_info' => [
                    'title' => 'Advanced Information',
                    'icon' => 'bx-lock-alt',
                    'description' => 'Additional company details and social media presence'
                ],
                'financial_info' => [
                    'title' => 'Financial Information',
                    'icon' => 'bx-detail',
                    'description' => 'Banking details and payment information'
                ],
                'settings_preferences' => [
                    'title' => 'Settings & Preferences',
                    'icon' => 'bx-bell',
                    'description' => 'Invoice settings and company preferences'
                ]
            ] as $category => $info)
                @php
                    $categoryData = $completionData[$category];
                    $statusColor = $service->getStatusColorClass($categoryData['status']);
                    $statusIcon = $service->getStatusIcon($categoryData['status']);
                    $statusText = $service->getStatusText($categoryData['status']);
                @endphp
                
                <li class="timeline-item timeline-item-transparent">
                    <span class="timeline-point timeline-point-{{ $statusColor }}"></span>
                    <div class="timeline-event">
                        <div class="mb-2 timeline-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="{{ $info['icon'] }} me-2"></i>
                                    <h6 class="mb-0">{{ $info['title'] }}</h6>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-label-{{ $statusColor }} me-2">{{ $statusText }}</span>
                                    <i class="{{ $statusIcon }} text-{{ $statusColor }}"></i>
                                </div>
                            </div>
                            <small class="text-muted">{{ $categoryData['completed'] }}/{{ $categoryData['total'] }} fields completed</small>
                        </div>
                        
                        <p class="mb-2">{{ $info['description'] }}</p>
                        
                        <!-- Progress Bar for Category -->
                        <div class="mb-2">
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-{{ $statusColor }}" 
                                     role="progressbar" 
                                     style="width: {{ $categoryData['percentage'] }}%"
                                     aria-valuenow="{{ $categoryData['percentage'] }}" 
                                     aria-valuemin="0" 
                                     aria-valuemax="100">
                                </div>
                            </div>
                            <small class="text-muted">{{ $categoryData['percentage'] }}% Complete</small>
                        </div>

                        <!-- Incomplete Fields -->
                        @if($categoryData['completed'] < $categoryData['total'])
                            <div class="mt-2">
                                <small class="text-muted">Missing fields:</small>
                                <div class="mt-1">
                                    @foreach($categoryData['fields'] as $field)
                                        @if(!$field['completed'])
                                            <span class="mb-1 badge bg-label-secondary me-1">
                                                {{ ucwords(str_replace('_', ' ', $field['field'])) }}
                                            </span>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="mt-2">
                                <span class="badge bg-label-success">
                                    <i class="bx bx-check me-1"></i>All fields completed
                                </span>
                            </div>
                        @endif

                        <!-- Action Button -->
                        <div class="mt-3">
                            @php
                                $tabMap = [
                                    'basic_info' => 'basic-info',
                                    'advanced_info' => 'advanced-info',
                                    'financial_info' => 'financial-info',
                                    'settings_preferences' => 'settings-pref'
                                ];
                                $tabId = $tabMap[$category] ?? '#';
                            @endphp
                            
                            @if($tabId !== '#')
                                <a href="{{ route('company.profile', ['slug' => $company->slug]) }}#{{ $tabId }}" 
                                   class="btn btn-sm btn-{{ $statusColor }}"
                                   onclick="switchToTab('{{ $tabId }}')">
                                    <i class="bx bx-edit me-1"></i>
                                    {{ $categoryData['completed'] > 0 ? 'Update' : 'Complete' }} {{ $info['title'] }}
                                </a>
                            @endif
                        </div>
                    </div>
                </li>
            @endforeach

            <!-- Timeline End Indicator -->
            <li class="timeline-end-indicator">
                <i class="bx bx-check-circle"></i>
            </li>
        </ul>

        <!-- Summary Stats -->
        <div class="pt-3 mt-4 border-top">
            <div class="text-center row">
                <div class="col-3">
                    <div class="d-flex flex-column align-items-center">
                        <span class="mb-1 badge bg-label-success">{{ $completionData['basic_info']['completed'] }}</span>
                        <small class="text-muted">Basic Info</small>
                    </div>
                </div>
                <div class="col-3">
                    <div class="d-flex flex-column align-items-center">
                        <span class="mb-1 badge bg-label-primary">{{ $completionData['advanced_info']['completed'] }}</span>
                        <small class="text-muted">Advanced Info</small>
                    </div>
                </div>
                <div class="col-3">
                    <div class="d-flex flex-column align-items-center">
                        <span class="mb-1 badge bg-label-warning">{{ $completionData['financial_info']['completed'] }}</span>
                        <small class="text-muted">Financial Info</small>
                    </div>
                </div>
                <div class="col-3">
                    <div class="d-flex flex-column align-items-center">
                        <span class="mb-1 badge bg-label-info">{{ $completionData['settings_preferences']['completed'] }}</span>
                        <small class="text-muted">Settings</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function switchToTab(tabId) {
    // Find the tab link and click it
    const tabLink = document.querySelector(`a[href="#${tabId}"]`);
    if (tabLink) {
        tabLink.click();
    }
}
</script>

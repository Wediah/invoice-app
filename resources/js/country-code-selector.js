/**
 * Country Code Selector Enhancement
 * Provides better UX for country code selection
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize country code selectors
    initializeCountryCodeSelectors();
});

function initializeCountryCodeSelectors() {
    const countryCodeSelectors = document.querySelectorAll('select[name="country_code"]');
    
    countryCodeSelectors.forEach(selector => {
        // Add search functionality
        addSearchToCountrySelector(selector);
        
        // Add phone number formatting
        const phoneInput = selector.parentElement.querySelector('input[type="tel"], input[name*="phone"]');
        if (phoneInput) {
            addPhoneFormatting(phoneInput, selector);
        }
    });
}

function addSearchToCountrySelector(selector) {
    // Make the selector searchable
    if (typeof $ !== 'undefined' && $.fn.select2) {
        $(selector).select2({
            placeholder: 'Select Country',
            allowClear: false,
            width: '100%',
            templateResult: formatCountryOption,
            templateSelection: formatCountrySelection
        });
    }
}

function formatCountryOption(country) {
    if (!country.id) {
        return country.text;
    }
    
    // Extract flag and text from option
    const $country = $(country.element);
    const text = $country.text();
    
    // Create a span with flag and text
    const $result = $('<span></span>');
    $result.html(text);
    
    return $result;
}

function formatCountrySelection(country) {
    return country.text;
}

function addPhoneFormatting(phoneInput, countrySelector) {
    // Add input event listener for phone formatting
    phoneInput.addEventListener('input', function(e) {
        // Remove any non-numeric characters except +
        let value = e.target.value.replace(/[^\d+]/g, '');
        
        // If it starts with +, remove it as we'll add the country code
        if (value.startsWith('+')) {
            value = value.substring(1);
        }
        
        // Update the input value
        e.target.value = value;
    });
    
    // Add focus event to show country code
    phoneInput.addEventListener('focus', function() {
        const selectedCountry = countrySelector.value;
        if (selectedCountry) {
            const countries = getCountryData();
            const country = countries[selectedCountry];
            if (country) {
                phoneInput.placeholder = `e.g., ${country.code} 123 456 789`;
            }
        }
    });
}

function getCountryData() {
    // This would ideally be loaded from the server
    // For now, we'll use a simplified version
    return {
        'GH': { name: 'Ghana', code: '+233', flag: '🇬🇭' },
        'US': { name: 'United States', code: '+1', flag: '🇺🇸' },
        'GB': { name: 'United Kingdom', code: '+44', flag: '🇬🇧' },
        'NG': { name: 'Nigeria', code: '+234', flag: '🇳🇬' },
        'KE': { name: 'Kenya', code: '+254', flag: '🇰🇪' },
        'ZA': { name: 'South Africa', code: '+27', flag: '🇿🇦' },
        'IN': { name: 'India', code: '+91', flag: '🇮🇳' },
        'CA': { name: 'Canada', code: '+1', flag: '🇨🇦' },
        'AU': { name: 'Australia', code: '+61', flag: '🇦🇺' },
        'DE': { name: 'Germany', code: '+49', flag: '🇩🇪' },
        'FR': { name: 'France', code: '+33', flag: '🇫🇷' },
        'IT': { name: 'Italy', code: '+39', flag: '🇮🇹' },
        'ES': { name: 'Spain', code: '+34', flag: '🇪🇸' },
        'BR': { name: 'Brazil', code: '+55', flag: '🇧🇷' },
        'MX': { name: 'Mexico', code: '+52', flag: '🇲🇽' },
        'JP': { name: 'Japan', code: '+81', flag: '🇯🇵' },
        'CN': { name: 'China', code: '+86', flag: '🇨🇳' },
        'KR': { name: 'South Korea', code: '+82', flag: '🇰🇷' }
    };
}

// Initialize all country code selectors on page load
document.addEventListener('DOMContentLoaded', function() {
    // Find all country code selectors
    const countrySelectors = document.querySelectorAll('select[name*="country_code"]');
    
    countrySelectors.forEach(selector => {
        // Add phone formatting for each selector
        const phoneInput = selector.parentElement.querySelector('input[type="tel"], input[name*="phone"]');
        if (phoneInput) {
            addPhoneFormatting(phoneInput, selector);
        }
    });
});

// Export for use in other modules
window.CountryCodeSelector = {
    initialize: initializeCountryCodeSelectors,
    addSearchToCountrySelector: addSearchToCountrySelector,
    addPhoneFormatting: addPhoneFormatting
};

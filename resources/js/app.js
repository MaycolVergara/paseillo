/**
 * Paseillo - Unified Application Entry Point
 * Centralizes Admin Dashboard and Public Web logic using a modular approach.
 */

import { initSidebar } from './admin/sidebar';
import { initTheme } from './admin/theme';
import { initClock } from './admin/clock';
import { initCalculator } from './admin/calculator';
import { initSearchPicker } from './admin/search-picker';
import { initPagination } from './admin/pagination';
import { initUtils } from './admin/utils';
import { initSettings } from './admin/settings';
import { initReports } from './admin/reports';
import { initStaffAbsence } from './admin/staff';

// Wait for DOM to be ready
document.addEventListener('DOMContentLoaded', () => {
    
    // 1. SHARED / CORE LOGIC
    // Always initialize theme to avoid flicker
    initTheme();
    
    // 2. ADMIN DASHBOARD LOGIC (Conditional)
    // Only runs if we are in the admin area (detected by sidebar or main-area)
    if (document.getElementById('sidebar') || document.getElementById('main-area')) {
        console.log('--- Paseillo Admin Initialized ---');
        initSidebar();
        initClock();
        initPagination();
        initUtils();
        initSettings();
        initReports();
        initStaffAbsence();
        
        // Form & Order specific logic
        if (document.getElementById('select-producto')) {
            initCalculator();
        }
        if (document.getElementById('search-producto')) {
            initSearchPicker();
        }
    }
    
    // 4. LUCIDE ICONS (Global fallback)
    if (window.lucide) {
        window.lucide.createIcons();
    }
});

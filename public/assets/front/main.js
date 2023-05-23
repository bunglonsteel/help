"use strict"

const toggleSwitch      = document.querySelector('#darkModeToggle');
const loadMore          = document.querySelector('#load-more');
const currentTheme      = localStorage.getItem('theme');
const checkLocalStorage = _ => typeof Storage !== "undefined" ? TRUE : FALSE;

const listNoteWrap = document.querySelector('#list-notes');

// Function to switch Mode
const switchMode = mode => {
    if (mode === "dark") {
        document.documentElement.setAttribute('class', 'dark');
        if (checkLocalStorage) {
            localStorage.setItem('theme', 'dark');
        }
    } else {
        document.documentElement.setAttribute('class', 'light');
        if (checkLocalStorage) {
            localStorage.setItem('theme', 'light');
        }
    }
}

if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    switchMode('dark')
} else {
    switchMode('light')
}

if (currentTheme) {
    document.documentElement.setAttribute('theme', currentTheme);
    if (currentTheme === 'dark') {
        toggleSwitch.setAttribute('aria-checked', 'true');
    }
}

// Event listener for toggle switch
toggleSwitch.addEventListener('click', _ => {
    if (toggleSwitch.getAttribute('aria-checked') === 'true') {
        toggleSwitch.setAttribute('aria-checked', 'false');
        switchMode('light');
    } else {
        toggleSwitch.setAttribute('aria-checked', 'true');
        switchMode('dark');
    }
});

// var start      = 0
// var limit      = 6
// var totalCount = 0
// var loading    = false

// const showNotes = async url => {
//     try {
//         skeletonCard()
//         const res       = await fetch(url);
//         const listNotes = await res.json();

//         if (res.status == "200") {
//             let list = ''
//             if (listNotes.length > 0) {
//                 listNotes.forEach(e => {
//                     list += `
//                     <div class="border-b dark:border-slate-800 pb-3.5">
//                         <a href="#">
//                             <h3 class="mb-3 font-semibold tracking-normal text-slate-600 dark:text-slate-400 hover:text-teal-600 leading-5">${e.title}</h3>
//                         </a>
//                         <p class="text-sm text-slate-600 dark:text-slate-500 mb-2 line-clamp-2">Consecterur adispicing elit. Nulla sit amet libero 
//                             non ante ia culis la bibendum ullamcorper. 
//                             Nullam ultrices vel mauris porttitor feugia euismod. 
//                             Aliquam a tortor et lectus efficitur egestas id vitae arcuin as date an your health</p>
//                         ${e.show_contact == "true" ? `<div class="text-slate-400 text-xs lg:text-[13px]">
//                         <span>If you want to know more, please </span>
//                         <a class="text-teal-600" href="#">contact the factory</a>
//                     </div>` : ''}
//                     </div>
//                     `;
//                 });
//             } else {
//                 listNotes.innerHTML = 'nodata'
//             }
//             listNoteWrap.innerHTML = list
//         }
//     } catch (error) {
//         return 
//     }

// }

// const skeletonCard = _ => {
//     const INIT_CARD_NOTES = 6
//     let   list            = '';

//     for (var i = 0; i < INIT_CARD_NOTES; i++) {
//         list += `
//             <div class="border-b animate-pulse dark:border-slate-800 pb-3.5">
//                 <div class="bg-slate-200 dark:bg-slate-600  h-4 mb-5 w-3/5 rounded-lg"></div>
//                 <div class="bg-slate-200 dark:bg-slate-600 h-3 rounded-lg mb-2"></div>
//                 <div class="bg-slate-200 dark:bg-slate-600 h-3 w-11/12 rounded-lg mb-4"></div>
//                 <div class="bg-slate-200 dark:bg-slate-600 h-2.5 w-4/5 rounded-lg"></div>
//             </div>
//         `
//     }

//     listNoteWrap.innerHTML = list
// }

// loadMore.addEventListener('click', function(e){
//     start = limit
//     limit = limit + 6
//     loadMore.innerHTML = `<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-teal-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
//                             <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
//                             <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
//                         </svg>
//                         Loading...`
    // showNotes(`http://localhost:3000/notes?_start=${start}&end=${limit}`)
    // loadMore.innerHTML = "Load More..."
// })

// showNotes(`http://localhost:3000/notes?_start=${start}&_limit=${limit}`)

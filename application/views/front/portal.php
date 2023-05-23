<div class="relative bg-teal-600 dark:bg-slate-700/10 h-80 rounded-b-3xl bg-no-repeat bg-cover bg-center" style="background-image: url('<?= base_url('public/image/default/overlay.png') ?>');">
    <form class="flex flex-col justify-center items-center h-full">
        <h1 class="text-4xl font-bold text-white mb-5">Help Center</h1>
        <div class="flex items-center relative">
            <input id="search" class="py-3.5 pl-4 pr-12 rounded-[10px] outline-none text-sm w-72 md:w-96 dark:bg-slate-700 dark:text-slate-300" type="text" placeholder="Search...">
            <button type="submit" class="absolute right-1.5 bg-slate-100 p-3 rounded-[10px] dark:bg-slate-500">
                <svg class="h-3.5 dark:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </button>
        </div>
    </form>
    <div class="absolute flex gap-2 items-center top-5 right-5">
        <div id="darkModeToggle" class="relative w-12 h-7 bg-slate-100 dark:bg-slate-600 transition-transform duration-200 ease-linear rounded-full shadow-lg" aria-checked="false">
            <span class="bg-white absolute flex justify-center items-center top-1 left-1 w-5 h-5 rounded-full shadow-md transition duration-200 ease-linear opacity-1">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                </svg>
            </span>
            <span class="bg-white absolute flex justify-center items-center top-1 right-1 w-5 h-5 rounded-full shadow-md transition duration-200 ease-linear opacity-0">
                <svg class="w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
                </svg>
            </span>
        </div>
        <?php if ($this->user->type == "superadmin") : ?>
            <a href="<?= base_url('admin/dashboard') ?>" class="flex gap-1 bg-slate-50 py-2 px-3 text-xs leading-4 rounded-lg font-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                <span>Dashboard</span>
            </a>
        <?php endif; ?>
    </div>
</div>

<div class="mx-auto max-w-7xl lg:px-5 px-3 w-full -mt-10">
    <div id="top-posts" class="grid grid-cols-1 md:grid-cols-3 gap-3 lg:gap-8 justify-center mb-14">

    </div>
</div>

<div class="max-w-7xl lg:px-5 mx-auto">
    <div class="flex flex-col md:flex-row lg:flex-row">
        <div class="w-full md:mr-5 mb-10 max-w-full md:max-w-[19rem] max-h-80 md:max-h-full overflow-y-scroll md:overflow-y-hidden">
            <h3 id="sd" class="mb-3 font-bold ml-5 text-slate-600 dark:text-slate-300">Select Category :</h3>
            <ul id="list-categories" class="border-l dark:border-slate-800 relative">

            </ul>
        </div>

        <div class="w-full">
            <div id="list-child-categories" class="flex flex-nowrap md:flex-wrap overflow-x-scroll md:overflow-hidden w-full gap-2 pb-3 mb-8 md:pb-8 md:mb-0">

            </div>
            <div id="list-posts" class="grid grid-cols-1 md:grid-cols-2 gap-3 lg:gap-8 auto-rows-auto">

            </div>

            <div id="wrap-more" class="relative mb-8 md:mb-16">

            </div>
        </div>
    </div>
</div>

<script>
    var currentCategory = '';
    var pages = 1;
    var limitPosts = 8;
    var offsetPosts = 0


    const urlTopPosts = "<?= base_url('top_posts') ?>"
    const urlCategories = "<?= base_url('categories') ?>"
    const urlPosts = "<?= base_url('list_posts') ?>"

    const wrapTopPosts = $('#top-posts')
    const wrapListCategory = $('#list-categories')
    const wrapListChildCategories = $('#list-child-categories')
    const wrapListPosts = $('#list-posts')
    const wrapMore = $('#wrap-more')

    const topPosts = _ => {
        $.ajax({
            type: "GET",
            url: urlTopPosts,
            data: "csrf_token=" + csrf.attr('content'),
            cache: true,
            dataType: "JSON",
            beforeSend: _ => {
                let skeleton = ''
                for (let i = 0; i < 3; i++) {
                    skeleton += `
                        <div class="flex items-center gap-5 animate-pulse bg-white dark:bg-slate-800/40 backdrop-blur dark:border border-slate-800 w-full p-5 shadow-lg rounded-lg">
                            <div class="flex-grow">
                                <div class="bg-slate-200 dark:bg-slate-600 h-4 mb-2.5 w-3/5 rounded-lg"></div>
                                <div class="bg-slate-200 dark:bg-slate-600 h-3 w-full rounded-lg mb-2"></div>
                                <div class="bg-slate-200 dark:bg-slate-600 h-3 w-11/12 rounded-lg"></div>
                            </div>
                            <div class="bg-slate-200 dark:bg-slate-600 h-14 w-14 rounded-lg"></div>
                        </div>
                        `
                }
                wrapTopPosts.append(skeleton)
            },
            success: response => {
                csrf.attr('content', response.csrf_hash)
                wrapTopPosts.html('')
                if (response.success) {
                    if (response.data.length > 0) {
                        response.data.forEach(post => {
                            wrapTopPosts.append(`
                                    <div class="group flex items-center gap-2 bg-white dark:bg-slate-800/40 backdrop-blur dark:border border-slate-800 w-full p-5 shadow-lg rounded-lg">
                                        <div class="flex-grow self-start">
                                            <h3 class="text-lg font-bold text-slate-600 dark:text-slate-400 line-clamp-1 group-hover:text-teal-600"><a href="<?= base_url('post/') ?>${post.slug}">${post.title}</a></h3>
                                            <p class="text-sm line-clamp-2">${post.description}</p>
                                        </div>
                                        <a href="<?= base_url('post/') ?>${post.slug}" class="flex-shrink text-sm group-hover:text-teal-600 bg-slate-50 border dark:border-slate-800 dark:bg-slate-900 p-3 rounded-lg text-center">
                                            <svg class="w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                                            </svg>
                                        </a>
                                    </div>
                                `)
                        });
                    }
                }
            }
        });
    }

    const categoryLists = _ => {
        $.ajax({
            type: "GET",
            url: urlCategories,
            data: "csrf_token=" + csrf.attr('content'),
            cache: true,
            dataType: "JSON",
            beforeSend: function(e) {
                let skeleton = ''
                for (let i = 0; i < 5; i++) {
                    skeleton += `
                        <li class="ml-1">
                            <div class="animate-pulse px-5 py-3">
                                <div class="bg-slate-200 dark:bg-slate-600 h-4 mb-4 w-3/5 rounded-lg"></div>
                                <div class="bg-slate-200 dark:bg-slate-600 h-3 rounded-lg mb-2"></div>
                                <div class="bg-slate-200 dark:bg-slate-600 h-3 w-11/12 rounded-lg"></div>
                            </div>
                        </li>
                        `
                }
                wrapListCategory.append(skeleton)
            },
            success: function(response) {
                csrf.attr('content', response.csrf_hash)
                wrapListCategory.html('')
                if (response.success) {

                    if (response.data.length > 0) {
                        currentCategory = response.data[0].category_id
                        response.data.forEach((category, index) => {
                            const active = index == 0 ? 'active' : '';
                            wrapListCategory.append(`
                                    <li class="ml-1 ${active}">
                                        <a href="#" data-category-id="${category.category_id}" class="parent-categories block px-5 py-3 hover:bg-slate-100 hover:rounded-lg dark:hover:bg-slate-800/40">
                                            <span class="font-semibold inline-block mb-1 text-slate-600 dark:text-slate-400">${category.category}</span>
                                            <p class="text-sm">${category.desc}</p>
                                        </a>
                                    </li>
                                `)
                        });
                    } else {
                        wrapListCategory.append(`<li class="ml-1 ">
                                        <span class="block px-5 py-3">
                                            <span class="text-3xl font-semibold inline-block mb-1 text-slate-600 dark:text-slate-400"> 🥹 </span>
                                            <p class="text-sm">Maaf masih kosong</p>
                                        </span>
                                    </li>
                                    `)
                    }

                }
                childCategories(currentCategory)
                postsLists(limitPosts, offsetPosts, false, currentCategory)
            }
        });
    }

    const postsLists = (limit, offset, isLoadMore, category_id = '', search = '') => {
        $.ajax({
            type: "POST",
            url: urlPosts,
            data: {
                csrf_token: csrf.attr('content'),
                limit: limit,
                offset: offset,
                category: category_id,
                search: search,
            },
            cache: true,
            dataType: "JSON",
            beforeSend: function(e) {
                let skeleton = ''
                for (let i = 0; i < 6; i++) {
                    skeleton += `
                            <div class="skeleton border-b animate-pulse dark:border-slate-800 pb-3.5">
                                <div class="bg-slate-200 dark:bg-slate-600  h-4 mb-5 w-3/5 rounded-lg"></div>
                                <div class="bg-slate-200 dark:bg-slate-600 h-3 rounded-lg mb-2"></div>
                                <div class="bg-slate-200 dark:bg-slate-600 h-3 w-11/12 rounded-lg mb-4"></div>
                                <div class="bg-slate-200 dark:bg-slate-600 h-2.5 w-4/5 rounded-lg"></div>
                            </div>
                        `
                }
                wrapListPosts.append(skeleton)
            },
            success: function(response) {
                csrf.attr('content', response.csrf_hash)
                if (response.success) {
                    $('.skeleton').remove()
                    if (search) {
                        if (0 >= offset) {
                            wrapListPosts.html('')
                        }
                    }
                    if (response.data.length > 0) {
                        response.data.forEach((post, index) => {
                            wrapListPosts.append(`
                                <div class="border-b dark:border-slate-800 pb-3.5">
                                    <a href="<?= base_url('post/') ?>${post.slug}">
                                        <h3 class="target-select text-lg mb-3 font-semibold tracking-normal text-slate-600 dark:text-slate-400 hover:text-teal-600 leading-5">${post.title}</h3>
                                    </a>
                                    <p class="text-sm text-slate-600 dark:text-slate-500 mb-2 line-clamp-2">${post.description}</p>
                                </div>
                            `)
                        });

                    } else {
                        if (!isLoadMore) {
                            wrapListPosts.append(`
                                        <div class="col-span-2 px-5 py-3 text-center dark:bg-slate-800/50 backdrop-blur border dark:border-slate-800 rounded-xl py-10">
                                            <span class="text-3xl font-semibold inline-block mb-1 text-slate-600 dark:text-slate-400"> 🥹 </span>
                                            <p class="text-sm">Mohon maaf tidak ada.</p>
                                        </div>
                                    `)
                        }
                    }

                }
                if (response.data.length >= limitPosts) {
                    pages = pages + 1
                    offsetPosts = (pages - 1) * limitPosts;
                    buttonLoadMore()
                } else {
                    wrapMore.html('')
                }
            }
        });
    }

    const buttonLoadMore = _ => {
        wrapMore.append(
            `<div class="text-center pointer-events-none inset-x-0 bg-gradient-to-t from-white dark:from-slate-900 pt-40 pb-8 -mt-36 absolute rounded-b-3xl">
                    <button id="load-more" type="button" class="pointer-events-auto py-3 px-6 mr-2 text-sm font-medium bg-white rounded-xl border border-slate-200 hover:bg-slate-50 text-teal-600 dark:bg-slate-800 dark:text-slate-400 hover:dark:bg-slate-700 dark:border-slate-600 inline-flex items-center">
                        Load More...
                    </button>
                </div> `)
    }

    const childCategories = (category_id) => {
        $.ajax({
            type: "GET",
            url: urlCategories,
            data: `csrf_token=${csrf.attr('content')}&child=${category_id}`,
            cache: true,
            dataType: "JSON",
            beforeSend: function(e) {
                console.log()
                let skeleton = ''
                for (let i = 0; i < 7; i++) {
                    skeleton += `
                            <div class="w-28 h-9 animate-pulse bg-slate-200 dark:bg-slate-600 rounded-xl"></div>
                        `
                }
                wrapListChildCategories.append(skeleton)
            },
            success: function(response) {
                csrf.attr('content', response.csrf_hash)
                wrapListChildCategories.html('')
                if (response.success) {
                    if (response.data.length > 0) {
                        response.data.forEach((child, index) => {
                            wrapListChildCategories.append(`
                                    <button data-category-id="${child.category_id}" class="child-categories shrink-0 text-xs py-2 px-5 bg-white border backdrop-blur dark:bg-slate-800/70 dark:border-slate-800 rounded-xl hover:shadow-lg">
                                        # ${child.category}
                                    </button>
                                `)
                        });
                    }
                }
            },
            error: function(XHR, Text) {
                wrapListChildCategories.html('')
            }
        });
    }

    $(document).on('click', '#load-more', function(e) {
        $(this).html(
            `<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-teal-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Loading...
                `)
        if ($('#search').val()) {
            postsLists(limitPosts, offsetPosts, false, '', $('#search').val())
        } else {
            postsLists(limitPosts, offsetPosts, true, currentCategory)
        }
        $(this).html('Load More...')
    })

    $(document).on('click', '.parent-categories, .child-categories', function(e) {

        if ($(this).hasClass('parent-categories')) {
            wrapListCategory.children().removeClass('active')
            $(this).parent().addClass('active')
        }
        $('html, body').animate({
            scrollTop: $('#list-child-categories').offset().top - 20
        }, 'slow');
        currentCategory = $(this).data('category-id')
        wrapListPosts.html('')
        childCategories(currentCategory)
        postsLists(limitPosts, 0, false, currentCategory)
    })

    $(document).on('submit', 'form', function(e) {
        e.preventDefault()
        $('html, body').animate({
            scrollTop: $('#list-child-categories').offset().top - 20
        }, 'slow');
        if ($('#search').val()) {
            postsLists(limitPosts, 0, false, '', $('#search').val())
        } else {
            alert('Tidak boleh kosong')
        }
    })

    topPosts();
    categoryLists();
</script>

<script>
    $(document).ready(function() {
        $('.target-select').highlight('veniam');
    });
</script>
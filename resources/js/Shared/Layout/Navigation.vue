<template>
  <nav class="space-y-1">
    <inertia-link
      :href="route('admin.dashboard')"
      class="group flex items-center px-2 py-2 text-base leading-6 font-medium rounded-md focus:outline-none focus:text-white focus:bg-indigo-700 transition ease-in-out duration-150"
      :class="isUrl('admin') ? 'text-white bg-indigo-900' : 'text-indigo-300 hover:text-white hover:bg-indigo-700'"
    >
      <svg
        class="mr-3 h-6 w-6 text-indigo-400 group-focus:text-indigo-300 transition ease-in-out duration-150"
        fill="currentColor"
        viewBox="0 0 20 20"
      >
        <path
          d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"
        />
      </svg>
      Dashboard
    </inertia-link>
    <div>
      <span
        class="group flex items-center px-2 py-2 text-base leading-6 font-medium text-indigo-300 rounded-md focus:outline-none focus:text-white focus:bg-indigo-700 transition ease-in-out duration-150"
      >
        <svg
          class="mr-3 h-6 w-6 text-indigo-400 group-focus:text-indigo-300 transition ease-in-out duration-150"
          viewBox="0 0 20 20"
          fill="currentColor"
        >
          <path
            d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"
          />
        </svg>
        Books
      </span>
      <div class="space-y-1">
        <inertia-link
          :href="route('admin.books.genres.index')"
          class="pl-10 group flex items-center px-2 py-2 text-base leading-6 font-medium rounded-md focus:outline-none focus:text-white focus:bg-indigo-700 transition ease-in-out duration-150"
          :class="isUrl('admin/books/genres') ? 'text-white bg-indigo-900' : 'text-indigo-300 hover:text-white hover:bg-indigo-700'"
        >
          Genres
        </inertia-link>
        <inertia-link
          :href="route('admin.books.bookBindings.index')"
          class="pl-10 group flex items-center px-2 py-2 text-base leading-6 font-medium rounded-md focus:outline-none focus:text-white focus:bg-indigo-700 transition ease-in-out duration-150"
          :class="isUrl('admin/books/book-bindings') ? 'text-white bg-indigo-900' : 'text-indigo-300 hover:text-white hover:bg-indigo-700'"
        >
          Book Binding
        </inertia-link>
        <inertia-link
          :href="route('admin.books.languages.index')"
          class="pl-10 group flex items-center px-2 py-2 text-base leading-6 font-medium rounded-md focus:outline-none focus:text-white focus:bg-indigo-700 transition ease-in-out duration-150"
          :class="isUrl('admin/books/languages') ? 'text-white bg-indigo-900' : 'text-indigo-300 hover:text-white hover:bg-indigo-700'"
        >
          Languages
        </inertia-link>
        <inertia-link
          :href="route('admin.books.nationalities.index')"
          class="pl-10 group flex items-center px-2 py-2 text-base leading-6 font-medium rounded-md focus:outline-none focus:text-white focus:bg-indigo-700 transition ease-in-out duration-150"
          :class="isUrl('admin/books/nationalities') ? 'text-white bg-indigo-900' : 'text-indigo-300 hover:text-white hover:bg-indigo-700'"
        >
          Nationalities
        </inertia-link>
        <inertia-link
          :href="route('admin.books.tags.index')"
          class="pl-10 group flex items-center px-2 py-2 text-base leading-6 font-medium rounded-md focus:outline-none focus:text-white focus:bg-indigo-700 transition ease-in-out duration-150"
          :class="isUrl('admin/books/tags') ? 'text-white bg-indigo-900' : 'text-indigo-300 hover:text-white hover:bg-indigo-700'"
        >
          Tags
        </inertia-link>
      </div>
    </div>
    <inertia-link
      :href="route('admin.users.index')"
      class="group flex items-center px-2 py-2 text-base leading-6 font-medium rounded-md focus:outline-none focus:text-white focus:bg-indigo-700 transition ease-in-out duration-150"
      :class="isUrl('admin/users') ? 'text-white bg-indigo-900' : 'text-indigo-300 hover:text-white hover:bg-indigo-700'"
    >
      <svg
        class="mr-3 h-6 w-6 text-indigo-400 group-focus:text-indigo-300 transition ease-in-out duration-150"
        viewBox="0 0 20 20"
        fill="currentColor"
      >
        <path
          d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"
        />
      </svg>
      Users
    </inertia-link>
  </nav>
</template>

<script>
export default {
  methods: {
    isUrl(...urls) {
      const currentUrl = location.pathname.substr(1)

      if (urls[0] === 'admin') {
        return currentUrl === 'admin'
      }

      return urls.filter(url => currentUrl.startsWith(url)).length
    },
  },
}
</script>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Suomen Kieli Tavuttaja</title>

        @vite('resources/css/app.css')
    </head>
    <body class="h-full">
    <div class="min-h-full">
  <nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="flex items-center">
          <div class="flex-shrink-0">

          </div>
          <div class="hidden md:block">
            <div class="ml-10 flex items-baseline space-x-4">

            </div>
          </div>
        </div>
        <div class="hidden md:block">
          <div class="ml-4 flex items-center md:ml-6">



          </div>
        </div>

      </div>
    </div>

  </nav>

  <header class="bg-white shadow">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-bold tracking-tight text-gray-900">Suomen kieli tavuttaja</h1>
    </div>
  </header>
  <main>
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
      <!-- Your content -->
@isset($lauset)
      <div class="top-full z-10 mt-3 col-span-full overflow-hidden rounded-xl bg-white shadow-lg ring-1 ring-gray-900/5">
          <div class="p-4">
      {{ $lauset }}
          </div>
      </div>
@endisset
      <form method="POST" action="/tavu">
          @csrf

          <div class="col-span-full">
          <div class="mt-2">
            <textarea id="textarea" name="textarea" rows="8" class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required></textarea>
          </div>
          <p class="mt-3 text-sm leading-6 text-gray-600">Liitä kappaleita, lauseita tai sanoja lomakkeeseen ja napsauta sitten tavuta.</p>
        </div>
        <div class="mt-6 flex items-center justify-end gap-x-6">
          <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Peru</button>
          <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tavuta</button>
        </div>
      </form>
    </div>
  </main>
</div>
  </body>
</html>

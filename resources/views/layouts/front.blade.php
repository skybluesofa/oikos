<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
  .round {
    border-radius: 50%;
  }
</style>

<div class="w-full flex flex-row flex-wrap">

    <div class="w-full bg-red-500 sm:bg-orange-500 md:bg-yellow-500 lg:bg-green-500 xl:bg-blue-500 h-screen flex flex-row flex-wrap justify-center ">
    
        <!-- Begin Navbar -->
    
        <div class="bg-white shadow-lg border-t-4 border-indigo-500 absolute bottom-0 w-full md:w-0 md:hidden flex flex-row flex-wrap">
            <div class="w-full text-right"><button class="p-2 fa fa-bars text-4xl text-gray-600"></button></div>
        </div>
    
        <div class="w-0 md:w-2/12 lg:w-1/12 h-0 md:h-screen overflow-y-hidden bg-gray-900 shadow-lg">
            <div class="p-5 bg-gray-900 sticky top-0">
                <img class="border border-indigo-100 shadow-lg round" src="http://lilithaengineering.co.za/wp-content/uploads/2017/08/person-placeholder.jpg">
                <div class="pt-2 w-full text-center text-lg text-gray-600">
                    Thomas Jameson
                </div>
            </div>
            <div class="w-full h-screen antialiased flex flex-col hover:cursor-pointer">
                <a class="hover:bg-gray-800 hover:text-gray-500 p-3 w-full text-md text-center text-gray-700 font-semibold" href=""><div class="text-2xl pb-1"><i class="fa fa-book block text-2xl"></i></div>Entries</a>
                <a class="hover:bg-gray-800 hover:text-gray-500 p-3 w-full text-md text-center text-gray-700 font-semibold" href=""><div class="text-2xl pb-1"><i class="fa fa-heart block text-2xl"></i></div>Friends</a>
                <a class="hover:bg-gray-800 hover:text-gray-500 p-3 w-full text-md text-center text-gray-700 font-semibold" href=""><div class="text-2xl pb-1"><i class="fa fa-cog block text-2xl"></i></div>Settings</a>
                <a class="hover:bg-gray-800 hover:text-gray-500 p-3 w-full text-md text-center text-gray-700 font-semibold" href=""><div class="text-2xl pb-1"><i class="fa fa-arrow-left block text-2xl"></i></div>Log Out</a>
            </div>
        </div>
    
        <!-- End Navbar -->
        
        <div class="w-full md:w-10/12 lg:w-11/12 p-5 md:px-12 lg:24 h-full overflow-x-scroll antialiased">
            <div class="bg-white w-full shadow rounded-lg p-5">
                <textarea class="bg-gray-200 w-full rounded-lg shadow border p-2" rows="5" placeholder="Speak your mind"></textarea>
                
                <div class="w-full flex flex-row flex-wrap mt-3">
                    <div class="w-1/3">
                        <select class="w-full p-2 rounded-lg bg-gray-200 shadow border float-left">
                            <option>Public</option>
                            <option>Private</option>
                        </select>
                    </div>
                    <div class="w-2/3">
                        <button type="button" class="float-right bg-indigo-400 hover:bg-indigo-300 text-white p-2 rounded-lg">Submit</button>
                    </div>
                </div>
            </div>
        
            <div class="mt-3 flex flex-col pb-5">
            
                @each('components/post', $posts, 'post')
                @each('components/post', $posts, 'post')
                @each('components/post', $posts, 'post')

            </div>
        </div>
    </div>

</div>
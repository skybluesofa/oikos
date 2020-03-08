<div class="bg-white w-full xl:max-w-screen-xl mx-auto shadow rounded-lg p-5">
    {!! Form::open(['url' => 'foo/bar']) !!}
    <textarea class="bg-gray-200 w-full rounded-lg shadow border p-2" rows="5" placeholder="Speak your mind"></textarea>
    
    <div class="w-full flex flex-row flex-wrap mt-3">
        <div class="w-2/3 sm:w-1/3 md:w-1/2 lg:w-1/3 xl:w-1/4">
            <select class="w-full p-2 rounded-lg bg-gray-200 shadow border float-left">
                <option>Share with Friends</option>
                <option>Share with Everyone</option>
                <option>Keep Private</option>
            </select>
        </div>
        <div class="w-1/3 sm:w-2/3 md:w-1/2 lg:w-2/3 xl:w-3/4">
            <button type="button" class="float-right bg-indigo-400 hover:bg-indigo-300 text-white p-2 rounded-lg">Submit</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>

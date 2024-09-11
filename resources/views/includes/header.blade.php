<form action="{{route('search')}}" method="POST">
  @csrf
  <div class="flex flex-rox p-5">
    <div class="w-6/12">
      <input type="text" name="address" id="address" autocomplete="off" class="p-2 w-full bg-gray-200 rounded-md" value="{{ $keyword ?? '' }}">
      <div id="address-suggestions"></div>
    </div>
    <div class="w-6/12">
      <select name="category" id="category" class="p-2 mr-5 bg-gray-200 w-full rounded-md appearance-none text-gray-700 pr-8">
        <option value="">حدّد التصنيف</option>
        @foreach ($categories as $category)
            <option value="{{$category->id}}" {{ isset($category_id) && $category->id == $category_id ? 'selected' : ''}}>{{$category->title}}</option>
        @endforeach
      </select>
    </div>
    <div class="mr-5">
      <button type="submit" class="py-2 px-5 bg-gray-500 hover:bg-gray-400 text-white mr-5 rounded-md">
        بحث
      </button>
    </div>
  </div>
</form>

<section class="m-auto text-center">
  <div class="category mt-5">
    <ul>
      @foreach($categories as $category)
        <li>
          <a href="{{route('category.show', $category->slug)}}" class="bg-blue-900 hover:bg-gray-400">
            {{$category->title}}
          </a>
        </li>
      @endforeach
    </ul>
  </div>
</section>
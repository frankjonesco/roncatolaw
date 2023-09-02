{{-- Category list --}}
<select id="categoryList" name="category" onchange="getTopics(this)" class="text-3xl text-thin text-gray-600 w-4/5 text-center mx-auto mb-10">
    <option>All categories</option>
    @foreach ($categories as $category)
        <option value="{{$category->id}}">{{$category->title}}</option>
    @endforeach
</select>

{{-- Topic list --}}
<select id="topicList" name="topic" class="text-3xl text-thin text-gray-600 w-4/5 text-center mx-auto mb-10">
    <option disabled selected>All topics</option>
</select>


<script>
    // category and Topic lists
    const categoryList = document.getElementById('categoryList');
    const topicList = document.getElementById('topicList');

    // Create a Document Fragment
    const list = document.createDocumentFragment();

    // getTopics function (onchange)
    function getTopics(e){

        // API URL for the selected category
        let url = 'https://roncato.test/api/options/'+e.value;

        // Empty the current topic list
        topicList.innerHTML = "";

        // Fetch the URL
        fetch(url)
            .then((response) => {
                return response.json();
            })
            .then((data) => {
                let topics = data;

                // Create options for the topic list
                topics.map(function(topic) {
                    let option = document.createElement('option');
                    let title = option.text = `${topic.title}`;
                    let value = option.value = `${topic.id}`;

                    list.appendChild(option);
                });

                // console.log(list);
                topicList.appendChild(list);

            })
            .catch(function(error) {
                console.log(error);
            });
                    
    }
</script>
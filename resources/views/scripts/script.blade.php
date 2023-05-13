<script>
    window.addEventListener('pageshow', function (event) {
        var searchInput = document.getElementById('search-input');
        if (searchInput) {
            searchInput.value = "{{ request('query') }}";
        }
    });
    $(document).ready(function () {
        var timer; // declare timer variable
        var suggestionsContainer = $('#search-suggestions'); // cache the suggestions container

        $('#search-input').on('input', function () {
            clearTimeout(timer); // clear the timer on every input change
            var query = $(this).val();
            timer = setTimeout(function () { // set a new timer after input change
                $.ajax({
                    url: '{{ route("search") }}',
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        query: query
                    },
                    success: function (data) {
                        var suggestions = '';
                        if (query === '') {
                            // clear the suggestions if query is empty
                            suggestionsContainer.html('');
                            return;
                        }
                        $.each(data.users, function (index, user) {
                            suggestions += '<li><a href="' + user
                                .profile_url +
                                '">' + user.name + '</a></li>';
                        });

                        $.each(data.tags, function (index, tag) {
                            suggestions += '<li><a href="' + tag.url +
                                '">' + tag
                                .name + '</a></li>';
                        });

                        $.each(data.posts, function (index, post) {
                            suggestions +=
                                '<li><a href="' +
                                post
                                .url + '">' + post
                                .title + '</a></li>';
                        });

                        suggestionsContainer.html(suggestions);
                    }
                });
            }, 100); // wait for 100ms before sending request
        });

        // Hide suggestions on click outside of container
        $(document).click(function (event) {
            if (!$(event.target).closest('#search-container').length) {
                suggestionsContainer.empty();
            }
        });
    });

</script>

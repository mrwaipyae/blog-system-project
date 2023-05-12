<script>
    window.addEventListener('pageshow', function (event) {
        var searchInput = document.getElementById('search-input');
        if (searchInput) {
            searchInput.value = '{{ request('query') }}';
        }
    });
    $(document).ready(function () {
        var timer; // declare timer variable
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
                            $('#search-suggestions').html(suggestions);
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
                                '<li class="border"><a href="' +
                                post
                                .url + '">' + post
                                .title + '</a></li>';
                        });
                        $('#search-suggestions').html(suggestions);
                    }
                });
            }, 100); // wait for 500ms before sending request
        });
    });

</script>

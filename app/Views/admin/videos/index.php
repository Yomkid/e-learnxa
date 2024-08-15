<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videos Management | LearnXa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://player.vimeo.com/api/player.js"></script>
</head>
<body>

<div class="container mt-5">
    <h2>Lessons</h2>
    <table id="lessonTable" class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Has Video</th>
                <th>Has Quiz</th>
                <th>Has Assignment</th>
                <th>Has Resource</th>
                <th>Duration</th>
            </tr>
        </thead>
        <tbody id="lessonTableBody">
            <!-- Lesson rows will be appended here by JavaScript -->
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        fetchLessonData();

        function fetchLessonData() {
            $.ajax({
                url: '<?= base_url('lessons/getAllLessons') ?>',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    const lessons = response.lessons;
                    renderLessonTable(lessons);
                },
                error: function(error) {
                    console.error('Error fetching lesson data:', error);
                }
            });
        }

        function renderLessonTable(lessons) {
            const lessonTableBody = $('#lessonTableBody');
            lessonTableBody.empty();

            lessons.forEach(lesson => {
                const contentWithMedia = processOembed(lesson.lesson_content);
                const lessonRow = `
                    <tr>
                        <td>${lesson.lesson_id}</td>
                        <td>${lesson.lesson_title}</td>
                        <td>${contentWithMedia}</td>
                        <td>${lesson.has_video ? 'Yes' : 'No'}</td>
                        <td>${lesson.has_quiz ? 'Yes' : 'No'}</td>
                        <td>${lesson.has_assignment ? 'Yes' : 'No'}</td>
                        <td>${lesson.has_resource ? 'Yes' : 'No'}</td>
                        <td>${lesson.duration}</td>
                    </tr>
                `;
                lessonTableBody.append(lessonRow);
            });

            // Initialize Vimeo player if needed
            $('iframe').each(function() {
                const src = $(this).attr('src');
                if (src.includes('vimeo')) {
                    new Vimeo.Player($(this));
                }
            });
        }

        // Function to process <oembed> tags
        function processOembed(html) {
            // Replace <oembed> tags with appropriate <iframe> tags
            return html.replace(/<oembed url="([^"]+)"><\/oembed>/g, function(match, url) {
                // Determine the type of URL and create the appropriate iframe
                if (url.includes('vimeo.com')) {
                    // Extract the video ID from the Vimeo URL
                    const videoId = url.split('/').pop().split('?')[0];
                    return `<iframe width="560" height="315" src="https://player.vimeo.com/video/${videoId}?h=780dcf5138&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>`;
                } else if (url.includes('youtube.com') || url.includes('youtu.be')) {
                    // Extract the video ID from the YouTube URL
                    const videoId = new URL(url).searchParams.get('v') || url.split('/').pop().split('?')[0];
                    return `<iframe width="560" height="315" src="https://www.youtube.com/embed/${videoId}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
                } else {
                    // Default or unsupported URL
                    return `<p>Unsupported media type or URL: ${url}</p>`;
                }
            });
        }
    });
</script>

</body>
</html>

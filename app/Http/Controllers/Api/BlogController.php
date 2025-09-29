<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Blog::latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

        public function storeForm(Request $request)
    {
        $data = $request->validate([
            'title'                  => ['required', 'string', 'max:255'],
            'slug'                   => ['required', 'string', 'max:255'],
            'category'                  => ['required', 'string', 'max:55'],
            'excerpt'                => ['nullable', 'string', 'max:500'],

            'content'                => ['required', 'array'],
            'content.*.type'         => ['required'],
            'content.*.data'         => ['nullable', 'array'],
            'content.*.data.file'    => ['nullable', 'file', 'image', 'max:5120'],
            'content.*.data.src_url' => ['nullable', 'string'],
            'content.*.data.alt'     => ['nullable', 'string', 'max:255'],
            'content.*.data.caption' => ['nullable', 'string', 'max:255'],
            'content..data.style' => ['nullable'],
            'content..data.items' => ['nullable', 'array'],
            'content..data.items.' => ['nullable', 'string', 'max:500'],
            'published_at'           => ['nullable', 'date'],
        ]);

        $data['content'] = $this->processBlocks($request);

        $blog = Blog::create($data);

        if ($request->expectsJson()) {
            return new PostResource($blog);
        }
        return view('welcome');
    }

     private function processBlocks(Request $request): array
    {
        $blocks = $request->input('content', []);
        $out = [];

        foreach ($blocks as $i => $block) {
            $type = $block['type'] ?? null;
            $data = $block['data'] ?? [];
            if (!$type) continue;

            switch ($type) {

                case 'hero': {
                        $file = $request->file("content.$i.data.file");
                        if ($file) {
                            $path = $file->store('blog', 'public');
                            $data['image'] = $path;
                        }
                        $out[] = [
                            'type' => 'hero',
                            'data' => [
                                'title'     => $data['title'] ?? '',
                                'image'     => $data['image'] ?? null,
                                'image_url' => $data['image_url'] ?? null,
                            ],
                        ];
                        break;
                    }

                case 'heading':
                    $out[] = [
                        'type' => 'heading',
                        'data' => [
                            'text'  => $data['text'] ?? '',
                            'level' => isset($data['level']) ? (int) $data['level'] : 2,
                        ],
                    ];
                    break;

                case 'paragraph':
                    $out[] = [
                        'type' => 'paragraph',
                        'data' => [
                            'html' => $data['html'] ?? '',
                        ],
                    ];
                    break;



                case 'image': {
                        $file = $request->file("content.$i.data.file");
                        if ($file) {
                            $path = $file->store('blog', 'public'); // e.g., "blog/filename.jpg"
                            $data['src'] = $path; // stored disk path
                        }
                        $out[] = [
                            'type' => 'image',
                            'data' => [
                                'src'     => $data['src']     ?? null,   // from uploaded file
                                'src_url' => $data['src_url'] ?? null,   // from pasted URL
                                'alt'     => $data['alt']     ?? '',
                                'caption' => $data['caption'] ?? '',
                            ],
                        ];
                        break;
                    }

                case 'quote':
                    $out[] = [
                        'type' => 'quote',
                        'data' => [
                            'text'   => $data['text']   ?? '',
                            'author' => $data['author'] ?? '',
                        ],
                    ];
                    break;

                case 'callout':
                    $out[] = [
                        'type' => 'callout',
                        'data' => [
                            'variant' => $data['variant'] ?? 'info',
                            'html'    => $data['html']    ?? '',
                        ],
                    ];
                    break;

                case 'problem_solution':
                    $out[] = [
                        'type' => 'problem_solution',
                        'data' => [
                            'number'  => isset($data['number']) ? (int) $data['number'] : null,
                            'title'   => $data['title']   ?? '',
                            'problem' => $data['problem'] ?? '',
                            'solution' => $data['solution'] ?? '',
                        ],
                    ];
                    break;
                case 'list': {
                        $style = ($data['style'] ?? 'ul') === 'ol' ? 'ol' : 'ul';
                        $rawItems = $data['items'] ?? [];
                        $items = [];
                        if (is_array($rawItems)) {
                            foreach ($rawItems as $it) {
                                $s = trim((string) $it);
                                if ($s !== '') $items[] = $s;
                            }
                        }
                        $out[] = [
                            'type' => 'list',
                            'data' => [
                                'style' => $style,
                                'items' => array_values($items),
                            ],
                        ];
                        break;
                    }
            }
        }

        return $out;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function individualBlog($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        return $blog;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    // Fetches all categories
    public function category()
    {
        $categories = Blog::select('category')->distinct()->pluck('category');

        return response()->json($categories);
  
    }

    // Fetches blog by category
    public function byCategory($category)
    {
        $blogs = Blog::where('category',$category)->latest()->take(5)->get();

        return response()->json($blogs);
       
    }

    public function getForm()
    {
        return view('submit-blog');
    }
}

<?php

namespace App\Http\Controllers;

use App\FAQ;
use App\FAQCategory;
use App\Http\Requests;
use App\Transformers\FaqTransformer;
use App\Translation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        $faqs = FAQCategory::with('translations', 'questions.translations')->get();

        return view('help.index', compact('faqs'));
    }

    /**
     * @param FAQ $question
     * @return mixed
     */
    public function show(FAQ $question)
    {
        $question->load('translations', 'category.translations');

        return view('help.show', compact('question'));
    }

    /**
     * @param Request $request
     * @param FaqTransformer $transformer
     * @return int
     */
    public function search(Request $request, FaqTransformer $transformer)
    {
        $query = $request->get('q');
        $result = [];

        if ($query) {
            $result = $transformer->transform($this->getHits($query));
        }

        return response()->json([
            'hits' => $result
        ]);
    }

    /**
     * Gets the search hits.
     *
     * @param $query
     * @return array
     */
    private function getHits($query)
    {
        if (config('app.locale') == 'en') {
            $result = FAQ::where('question', 'LIKE', "%$query%")->limit(20)->get();
        }

        else {
            $result = Translation::with('translatable')
                                 ->where('translatable_type', 'App\FAQ')
                                 ->where('language_id', 'ar')
                                 ->where('translatable_attribute', 'question')
                                 ->where('translation', 'LIKE', "%$query%")
                                 ->limit(20)
                                 ->get();

            $result = $this->collectFromTranslations($result);
        }

        return $result;
    }

    private function collectFromTranslations($translations)
    {
        $questions = new Collection();

        foreach ($translations as $translation) {
            $questions->add($translation->translatable);
        }

        return $questions;
    }
}

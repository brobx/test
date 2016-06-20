<?php

namespace App\Http\Controllers\Corporate;

use App\CorporateSlider;
use App\Helpers\ImageHelper;
use App\Http\Requests;
use Illuminate\Http\Request;

class SliderController extends CorporateController
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $sliders = $this->corporate->sliders()->paginate(20);

        return view('corporate.sliders.index', compact('sliders'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('corporate.sliders.create');
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if (!count($request->get('slides'))) {
            return redirect()->back()->withErrors('No Slides were added.');
        }

        if ($request->user()->is_corporate('manager')) {
            foreach ($request->get('slides') as $item) {

                $slider = $this->corporate->sliders()->create($item);

                $slider->addTranslation([
                    'translatable_attribute' => 'description',
                    'translation' => $item['description_ar']
                ]);
            }

            return redirect()->route('backend.corporate.sliders.index')
                             ->with('success', 'Slider updated successfully.');
        }

        foreach ($request->get('slides') as $item) {
            $item['translations'][] = [
                'translatable_attribute' => 'description',
                'translation' => $item['description_ar']
            ];

            CorporateSlider::requestCreate($item);
        }

        return redirect()->route('backend.corporate.sliders.index')
                         ->with('success', 'Slider submitted successfully.');
    }

    /**
     * @param CorporateSlider $slider
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(CorporateSlider $slider)
    {
        return view('corporate.sliders.edit', compact('slider'));
    }

    /**
     * @param Request $request
     * @param CorporateSlider $slider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, CorporateSlider $slider)
    {
        $input = $request->all();
        
        if($request->hasFile('image')) {
            ImageHelper::delete($slider->image);
            $input['image'] = ImageHelper::fromRequest($request)->save();
        }
        
        if ($request->user()->is_corporate('manager')) {
            $slider->update($input);

            $slider->updateTranslation('description', $request->get('description_ar'));

            return redirect()->route('backend.corporate.sliders.index')
                             ->with('success', 'Slider updated successfully.');
        }

        $input['translations'][] = [
            'translatable_attribute' => 'description',
            'translation' => $input['description_ar']
        ];

        $slider->requestUpdate($input);

        return redirect()->route('backend.corporate.sliders.index')
                         ->with('success', 'Slider changes submitted successfully.');
    }

    /**
     * @param CorporateSlider $slider
     * @return mixed
     * @throws \Exception
     */
    public function destroy(CorporateSlider $slider)
    {
        if (auth()->user()->is_corporate('manager')) {
            ImageHelper::delete($slider->image);
            $slider->delete();

            return redirect()->route('backend.corporate.sliders.index')
                             ->with('success', 'Slider deleted successfully.');
        }

        $slider->requestDelete();

        return redirect()->route('backend.corporate.sliders.index')
                         ->with('success', 'Slider deletion submitted successfully.');
    }
}

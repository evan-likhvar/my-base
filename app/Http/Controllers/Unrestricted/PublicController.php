<?php

namespace App\Http\Controllers\Unrestricted;

use App\Exceptions\NonExistException;
use App\Models\Category;
use App\Models\Note;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PublicController extends Controller
{
    private $categoryMenu;
    private $activeCategory;

    public function __construct()
    {
        parent::__construct();
        $this->template = $this->settings['theme-views-public'] . '.templates.base';
    }

    public function index(Request $request)
    {
        $this->activeCategory = $this->setActiveCategory($request->segments());
        $this->categoryMenu();
        $this->vars = Arr::add(
            $this->vars,
            'content',
            view($this->settings['theme-views-public'] . '.home.home')
                ->with([
                    'categoryMenu' => $this->categoryMenu,
                    'notes' => empty($this->activeCategory)
                        ? Note::publicPublished()
                            ->paginate($this->settings['index.notes.paginate'])
                        : Category::where('name',$this->activeCategory)->first()->notes()->publicPublished()
                            ->paginate($this->settings['index.notes.paginate']),
                    'settings' => $this->settings,
                    'locale'=>$this->vars['locale'],

                ])->render()
        );
        return $this->renderOut();
    }

    public function show(Note $note)
    {
        $this->activeCategory = $note->category->name;
        $this->categoryMenu();

        $this->vars = Arr::add(
            $this->vars,
            'content',
            view($this->settings['theme-views-public'] . '.note.note')
                ->with([
                    'categoryMenu' => $this->categoryMenu,
                    'note' => $note,
                    'settings' => $this->settings,
                    'locale'=>$this->vars['locale'],

                ])->render()
        );
        return $this->renderOut();
    }

    private function renderCategoryMenu(string $active = ''): string
    {
        return view($this->settings['theme-views-public'] . '.category-left-menu.category-left-menu')
            ->with([
                'active' => $active,
                'categories' => Category::all(),
                'locale'=>$this->vars['locale'],
            ])->render();
    }

    private function categoryMenu()
    {
        $this->categoryMenu = $this->renderCategoryMenu($this->activeCategory);
    }

    private function setActiveCategory(array $segments): string
    {

        //throw new NonExistException("can't find category - '$segments[1]' from http request");

        if (empty($segments) or $segments[0] != 'category' or empty($segments[1]))
            return '';

        //todo validate category name
        return $segments[1];
    }
}

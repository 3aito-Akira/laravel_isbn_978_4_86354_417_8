<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Book;
use App\Models\Author;
use Illuminate\Support\Facades\Hash;

class BookUpdateTest extends TestCase
{
    /**
     * A basic feature test example.
     */

     use RefreshDatabase;

     private $admin;
     private $categories;
     private $book;
     private $authors;

     public function setUp(): void
     {
        parent::setUp();

        $this->admin = Admin::factory()->create(['login_id' => 'hoge','password' => Hash::make('hogehoge')]);

        $this->categories = Category::factory(3)->create();

        $this->book = Book::factory()->create(['title' => 'Laravel Book', 'admin_id' => $this->admin->id,
        'category_id' => $this->categories[1]->id]);

        $this->authors = Author::factory(4)->create();

        $this->book->authors()->attach([$this->authors[0]->id,$this->authors[2]->id]);
     }

    public function test_regulateAccess(): void
    {
        $url = route('book.edit',$this->book);

        $this->get($url)->assertRedirect(route('admin.create'));

        $other = Admin::factory()->create();
        $this->actingAs($other,'admin');

        $this->get($url)->assertForbidden();

        $this->actingAs($this->admin,'admin');

        $this->get($url)->assertOk();
    }

    public function test_regulateUpdateAccess(): void
    {
        $url = route('book.update',$this->book);

        $param = [
            'category_id' => $this->categories[0]->id,
            'title' => 'New Laravel Book',
            'price' => '10000',
            'author_ids' => [$this->authors[1]->id,$this->authors[2]->id],    
        ];

        $this->put($url,$param)->assertRedirect(route('admin.create'));

        $other = Admin::factory()->create();
        $this->actingAs($other,'admin');

        $this->put($url,$param)->assertForbidden();

        $this->assertSame('Laravel Book',$this->book->fresh()->title);

    }

    public function test_validate():void
    {
        $this->actingAs($this->admin,'admin');

        $url = route('book.update',$this->book);

        $this->from(route('book.edit',$this->book))
        ->put($url,['category_id' => ''])
        ->assertRedirect(route('book.edit',$this->book));

        $this->put($url,['category_id' => ''])->assertInvalid(['category_id' => 'カテゴリは必ず']);

        $this->put($url,['category_id' => '0'])->assertInvalid(['category_id' => '正しい カテゴリ']);

        $this->put($url,['title' => ''])->assertInvalid(['title' => 'タイトルは必ず']);

        $this->put($url,['author_ids' => []])->assertInvalid(['author_ids' => '著者は必ず']);

        $this->put($url,['category_id' => $this->categories[2]->id])->assertValid('category_id');
    }

    public function test_update():void
    {
        $url = route('book.update',$this->book);

        $param = [
            'category_id' => $this->categories[0]->id,
            'title' => 'New Laravel Book',
            'price' => '10000',
            'author_ids' => [$this->authors[1]->id,$this->authors[2]->id],    
        ];

        $this->actingAs($this->admin,'admin');

        $this->put($url,$param)->assertRedirect(route('book.index'));

        $updatedBook = [
            //35行目に作った$this->bookのインスタンスには自動的にidが与えられていて、それを引き出している
            'id' => $this->book->id,
            'category_id' => $param['category_id'],
            'title' => $param['title'],
            'price' => $param['price'], 
        ];

        $this->assertDatabaseHas('books',$updatedBook);

        foreach ($this->authors as $author) {
            $authorBook = [
                'book_id' => $this->book->id,
                'author_id' => $author->id,
            ];

            if(in_array($author->id, $param['author_ids'])){
                $this->assertDatabaseHas('author_book',$authorBook);
            }
            else{
                $this->assertDatabaseMissing('author_book',$authorBook);
            }
        }

        $this->get(route('book.index'))->assertSee($param['title'].'を変更しました');

    }
}

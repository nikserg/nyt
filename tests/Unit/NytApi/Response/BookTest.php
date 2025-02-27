<?php

namespace Tests\Unit\NytApi\Response;

use App\NytApi\Response\Book;
use PHPUnit\Framework\TestCase;

class BookTest extends TestCase
{
    public function test_success_parsing(): void
    {
        $json = '{"title":"\"I GIVE YOU MY BODY ...\"","description":"The author of the Outlander novels gives tips on writing sex scenes, drawing on examples from the books.","contributor":"by Diana Gabaldon","author":"Diana Gabaldon","contributor_note":"","price":"0.00","age_group":"","publisher":"Dell","isbns":[{"isbn10":"0399178570","isbn13":"9780399178573"}],"ranks_history":[{"primary_isbn10":"0399178570","primary_isbn13":"9780399178573","rank":8,"list_name":"Advice How-To and Miscellaneous","display_name":"Advice, How-To & Miscellaneous","published_date":"2016-09-04","bestsellers_date":"2016-08-20","weeks_on_list":1,"rank_last_week":0,"asterisk":0,"dagger":0}],"reviews":[{"book_review_link":"a","first_chapter_link":"ab","sunday_review_link":"abc","article_chapter_link":"abcd"}]}';
        $book = new Book(json_decode($json, true));
        $this->assertEquals('"I GIVE YOU MY BODY ..."', $book->title);
        $this->assertEquals('The author of the Outlander novels gives tips on writing sex scenes, drawing on examples from the books.', $book->description);
        $this->assertEquals('by Diana Gabaldon', $book->contributor);
        $this->assertEquals('Diana Gabaldon', $book->author);
        $this->assertEquals('', $book->contributor_note);
        $this->assertEquals('0.00', $book->price);
        $this->assertEquals('', $book->age_group);
        $this->assertEquals('Dell', $book->publisher);
        $this->assertEquals('0399178570', $book->isbns[0]->isbn10);
        $this->assertEquals('9780399178573', $book->isbns[0]->isbn13);
        $this->assertEquals('0399178570', $book->ranks_history[0]->primary_isbn10);
        $this->assertEquals('9780399178573', $book->ranks_history[0]->primary_isbn13);
        $this->assertEquals(8, $book->ranks_history[0]->rank);
        $this->assertEquals('Advice How-To and Miscellaneous', $book->ranks_history[0]->list_name);
        $this->assertEquals('Advice, How-To & Miscellaneous', $book->ranks_history[0]->display_name);
        $this->assertEquals('2016-09-04', $book->ranks_history[0]->published_date);
        $this->assertEquals('2016-08-20', $book->ranks_history[0]->bestsellers_date);
        $this->assertEquals(1, $book->ranks_history[0]->weeks_on_list);
        $this->assertEquals(0, $book->ranks_history[0]->rank_last_week);
        $this->assertEquals(0, $book->ranks_history[0]->asterisk);
        $this->assertEquals(0, $book->ranks_history[0]->dagger);
        $this->assertEquals('a', $book->reviews[0]->book_review_link);
        $this->assertEquals('ab', $book->reviews[0]->first_chapter_link);
        $this->assertEquals('abc', $book->reviews[0]->sunday_review_link);
        $this->assertEquals('abcd', $book->reviews[0]->article_chapter_link);
    }

    public function test_success_parsing_with_empty_data(): void
    {
        $json = '{"title":null,"description":null,"contributor":null,"author":null,"contributor_note":null,"price":null,"age_group":null,"publisher":null,"isbns":null,"ranks_history":null,"reviews":null}';
        $book = new Book(json_decode($json, true));
        $this->assertNull($book->title);
        $this->assertNull($book->description);
        $this->assertNull($book->contributor);
        $this->assertNull($book->author);
        $this->assertNull($book->contributor_note);
        $this->assertNull($book->price);
        $this->assertNull($book->age_group);
        $this->assertNull($book->publisher);
        $this->assertNull($book->isbns);
        $this->assertNull($book->ranks_history);
        $this->assertNull($book->reviews);
    }
}

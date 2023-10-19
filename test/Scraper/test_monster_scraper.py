from importlib.machinery import SourceFileLoader
monster_scraper = SourceFileLoader('monster_scraper', 'code/Scraper/monster_scraper.py').load_module()


def test_monster_scraper_working(mocker):
    ans = monster_scraper.get_jobs("Software Engineer", "Raleigh", 10, ['Java', 'Python', 'Coding'])
    print(ans)
    assert ans is None


def test_monster_scraper_nonworking(mocker):
    mocker.patch.object(monster_scraper, 'requests')
    monster_scraper.requests.status_code.return_value = 999
    monster_scraper.requests.text.return_value = "Test"
    ans = monster_scraper.get_jobs("Software Engineer", "Raleigh", 10, ['Java', 'Python', 'Coding'])
    print(ans)
    assert ans is None

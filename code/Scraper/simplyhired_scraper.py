from bs4 import BeautifulSoup
import requests
import helper
import traceback


def get_jobs(role, location, count_jobs, all_skills):
    # URL = "https://www.simplyhired.com/search?q=software+engineer&l=San+Francisco"
    URL = "https://www.simplyhired.com/search?q="
    for r in role.split():
        URL = URL + r + "+"
    URL = URL.rstrip(URL[-1])

    URL = URL + "&l="

    for loc in location.split():
        URL = URL + loc + "+"
    URL = URL.rstrip(URL[-1])
    # print(URL)

    page = requests.get(URL)
    if page.status_code != 200:
        #print(url)
        print("Connection Failed!")
        print("-------------------------------------")
    soup = BeautifulSoup(page.content, 'html.parser')
    # print(soup.encode("utf-8"))

    results = soup.find_all('a', attrs={'class': 'SerpJob-link card-link'})
    urls = []
    job_title = []

    for result in results:
        if result.string is not None:
            job_title.append(result.string)
            urls.append('https://www.simplyhired.com' + result['href'])

    spans = soup.find_all('span', attrs={'class': 'JobPosting-labelWithIcon jobposting-company'})

    company_title = []
    for span in spans:
        if span.string is not None:
            # print(span.string)
            company_title.append(span.string)

    jobskills = []
    # desc = []
    for url in urls:
        urlpage = requests.get(url)
        bsresult = BeautifulSoup(urlpage.content, "html.parser")
        descwrap = bsresult.find_all('div', attrs={'class': 'p'})
        # desc.append(str(descwrap).encode('utf-8'))
        jobskills.append(helper.extract_skills(str(descwrap), all_skills))

    total_job = []

    try:
        for i in range(len(urls)):
            job_dict = {}
            job_dict['title'] = job_title[i]
            if job_dict['title'] is None:
                job_dict['title'] = role
            job_dict['url'] = urls[i]
            job_dict['company'] = company_title[i]
            job_dict['skills'] = jobskills[i]
            # job_dict['desc'] = desc[i]
            total_job.append(job_dict)

    except Exception as e:
        traceback.print_exc(e)

    # print(total_job)
    return total_job

# get_jobs("Software Engineer", "San Francisco", 5, helper.get_all_skills())

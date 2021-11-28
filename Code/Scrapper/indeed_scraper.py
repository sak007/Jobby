from bs4 import BeautifulSoup
import requests
import re
import helper
import traceback

def get_jobs(role, location, no_jobs, allskills):
    #URL = "http://www.indeed.com/jobs?q=software+engineer&l=Raleigh"
    URL = "http://www.indeed.com/jobs?q="
    for string in role.split():
        URL = URL + string + "+"
    URL = URL + "&l=" + location

    page = requests.get(URL)
    if page.status_code != 200:
        print(URL)
        print("Connection Failed")
    soup = BeautifulSoup(page.text, "html.parser")

    results = soup.find_all('a', attrs={'class': re.compile('tapItem fs-unmask result job_.*')})
    urls = []
    for result in results:
        if(result['href'][0:8] == '/rc/clk?'):
            urls.append("https://www.indeed.com/viewjob?" + result['href'][8:])
        elif result['href'][0:8] == '/pagead/':
            urls.append("https://www.indeed.com" + result['href'])
        elif result['href'][0:8] == '/company' :
            urls.append("https://www.indeed.com"  + result['href'])

    jobtitles = soup.find_all('div', attrs={'class' :'heading4 color-text-primary singleLineTitle tapItem-gutter'})
    for i in range(len(jobtitles)):
        if(jobtitles[i] is None):
            jobtitles[i] = jobtitles[i].find('span', attrs={'title':re.compile('.*')}).string

    companynames = soup.find_all('span', attrs={'class' :'companyName'})

    jobskills = []
    for url in urls:
        urlpage = requests.get(url)
        bsresult = BeautifulSoup(urlpage.text, "html.parser")
        descwrap = bsresult.find('div', attrs={'class' : 'jobsearch-jobDescriptionText'})
        jobskills.append(helper.extract_skills(str(descwrap), allskills))

    jobs = []
    try:
        for i in range(len(urls)):
            job = {}
            job["title"] = jobtitles[i].string
            if(job['title'] == None):
                job['title'] = role
            job["url"] = urls[i]
            job["company"] = companynames[i].string
            job["skills"] = jobskills[i]
            jobs.append(job)
    except Exception as e:
        traceback.print_exc()
        final_result = {}
    return jobs

if __name__ =='__main__':
    ans = get_jobs("Software Engineer", "Raleigh", 200, helper.get_all_skills())
    print(ans)

# URL = "https://www.indeed.com/jobs?q=software%20engineer&l=Raleigh%2C%20NC&vjk=cf09b5b8831f7bbd"
# page = requests.get(URL)
# soup = BeautifulSoup(page.text, "html.parser")

# results = soup.find_all('a', attrs={'class': re.compile('tapItem fs-unmask result job_.*')})
# for result in results:
#     if(result['href'][0:8] == '/rc/clk?'):
#         print("https://www.indeed.com/viewjob?" + result['href'][9:])
#     elif result['href'][0:8] == '/pagead/':
#         print("ad url " + "https://www.indeed.com" + result['href'])
#     elif result['href'][0:8] == '/company' :
#         print("company " + "https://www.indeed.com"  + result['href'])


# jobtitles = soup.find_all('div', attrs={'class' :'heading4 color-text-primary singleLineTitle tapItem-gutter'})
# for jobtitle in jobtitles:
#     if(jobtitle.string != None):
#         print(jobtitle.string)
#     else:
#         print(jobtitle.find('span', attrs={'title':re.compile('.*')}).string)

# companynames = soup.find_all('span', attrs={'class' :'companyName'})
# for companyname in companynames:
#     print(companyname.string)

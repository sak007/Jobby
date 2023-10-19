import json
import traceback
import requests
import helper


def get_jobs(role, location, no_of_jobs_to_retrieve, all_skills):
    url = "https://appsapi.monster.io/jobs-svx-service/v2/monster/search-jobs/samsearch/en-US?apikey=ulBrClvGP6BGnOopklreIIPentd101O2"
    payload = "{\"jobQuery\":{\"query\":\"" + role + "\",\"locations\":[{\"country\":\"us\",\"address\":\"" + location + "\",\"radius\":{\"unit\":\"mi\",\"value\":20}}]},\"jobAdsRequest\":{\"position\":[1,2,3,4,5,6,7,8,9],\"placement\":{\"component\":\"JSR_SPLIT_VIEW\",\"appName\":\"monster\"}},\"fingerprintId\":\"de72842ced49bea0d5d7f4d75a74002c\",\"offset\":0,\"pageSize\":9,\"includeJobs\":[]}head"
    headers = {
        'Accept': 'application/json',
        'Content-Type': 'application/json; charset=utf-8',
        'Origin': 'https://www.monster.com',
        'Content-Length': '338',
        'Accept-Language': 'en-us',
        'Host': 'appsapi.monster.io',
        'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.0 Safari/605.1.15',
        'Referer': 'https://www.monster.com/',
        'Accept-Encoding': 'gzip, deflate, br',
        'Connection': 'keep-alive',
        'request-starttime': '1637812719632'
    }

    response = requests.request("POST", url, headers=headers, data=payload)
    jobs_response = {}
    if response.status_code != 200:
        print("Connection Failed!")
        print("-------------------------------------")
        #print("Monster API ResponseCode:" + str(response.status_code) + ", ErrorMessage: " + response.text)
        #jobs_response['totalSize'] = 0
    else:
        jobs_response = json.loads(response.text)
        jobs = []
        job_details = {}
        try:
            for i in range(int(jobs_response['totalSize'])):
                job_data = jobs_response['jobResults'][i]["normalizedJobPosting"]
                if no_of_jobs_to_retrieve > 0:
                    job = {}
                    job["title"] = job_data['title']
                    job["url"] = job_data['url']
                    job_details[job["url"]] = [job["title"], ""]
                    no_of_jobs_to_retrieve -= 1
                    str3 = job_data['description']
                    job["skills"] = helper.extract_skills(str3, all_skills)
                jobs.append(job)
        except Exception:
            traceback.print_exc()
        return jobs

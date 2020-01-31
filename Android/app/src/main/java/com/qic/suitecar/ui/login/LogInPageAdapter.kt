package com.qic.suitecar.ui.login

import androidx.fragment.app.Fragment
import androidx.fragment.app.FragmentManager
import androidx.fragment.app.FragmentStatePagerAdapter

class LogInPageAdapter(fm: FragmentManager, private val mPageCount: Int) :
    FragmentStatePagerAdapter(
        fm,
        BEHAVIOR_RESUME_ONLY_CURRENT_FRAGMENT
    ) { //TODO: Deprecated 바꿨음 / 옵션 추가
    override fun getItem(position: Int): Fragment {

        return when (position) { //position에 따른 fragment 부르기
            0 -> {
                ForgottenFragment()
            }
            1 -> {
                SignInFragment()
            }
            2->{
                SignUpFragment()
            }
            else->{
                SignInFragment()
            }
        }
    }

    override fun getCount(): Int {
        return mPageCount

    }

    override fun getPageTitle(position: Int): CharSequence? { //타이틀 정하는 부분
        return when (position) {
            0 -> "Forgotten"
            1 -> "SignIn"
            2 -> "SignUp"
            else -> "SignIn"
        }
    }
}